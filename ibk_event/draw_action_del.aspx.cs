using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Data.SqlClient;
using System.Xml;
using System.IO;
using System.Net;
using System.Text;

public partial class www_draw_action : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
		
		if(Request.UserAgent.IndexOf("Android") > -1 || Request.UserAgent.IndexOf("iPhone") > -1){

			string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";
			string input_name = Request.Form["name"];
			string input_email = Request.Form["email"];
			string input_phone = Request.Form["phone"];
			string input_ipaddr = Request.UserHostAddress;
			string input_type = Request.Form["type"];
			string email_param = "email="+input_email;
			string sql = "";

			if( input_ipaddr == "121.128.159.26" || 
				input_ipaddr == "121.128.159.96" || 
				input_ipaddr == "110.11.239.201" || 
				input_ipaddr == "175.200.217.13" || 
				input_ipaddr == "110.10.185.247" || 
				input_ipaddr == "123.214.252.34" ||
				input_ipaddr == "211.211.40.50" ||
				input_ipaddr == "122.36.218.31" ||
				input_ipaddr == "110.10.204.55" ||
				input_ipaddr == "123.213.224.168" ||
				input_ipaddr == "110.9.18.41" ||
				input_ipaddr == "211.234.222.11"
			){//IP블랙리스트 거부
				Response.Write( "re" );
				return;
			}

			if(input_name != null && (input_email != null || input_phone != null) && input_type != null){//모두 NULL값이 아닌지 여부체크
				input_phone = input_phone.Replace("-", "").Replace(" ", "");
				SqlConnection conn = new SqlConnection(source);
				conn.Open();
				
				if(input_email == "none") sql = "SELECT count(no) FROM event_log WHERE phone = '" + input_phone + "'";
				else if(input_phone == "none") sql = "SELECT count(no) FROM event_log WHERE email = '" + input_email + "'";
				else sql = "SELECT count(no) FROM event_log WHERE phone = '" + input_phone + "' OR email = '" + input_email + "'";

				SqlCommand cmdCheckId = new SqlCommand(sql, conn);
				SqlDataReader reader = cmdCheckId.ExecuteReader();
				reader.Read();
				int cntQuery = int.Parse(reader[0].ToString());
				reader.Close();

				//Response.Write( cntQuery );

				if(cntQuery < 1){//이메일 또는 폰번호의 중복체크

					sql = "SELECT count(no) FROM event_log WHERE type like 'gifticon%' AND convert(varchar(10), regdate, 120)='" + DateTime.Now.ToShortDateString() + "'";
					SqlCommand cmdTodayCnt = new SqlCommand(sql, conn);
					reader = cmdTodayCnt.ExecuteReader();
					reader.Read();
					int todayCnt = int.Parse(reader[0].ToString());
					reader.Close();

					//Response.Write( todayCnt );
					
					if(todayCnt < 117 && (input_type == "gifticon" || input_type == "gifticon_set")){//기프티콘 건수가 하루 총 50건인지 확인하는 여부체크

						/*sql  = "INSERT INTO event_log(name, email, phone, ipaddr, type, regdate)";
						sql += "VALUES ('" + input_name+ "', ";
						sql += "'', ";
						sql += "'" + input_phone + "', ";
						sql += "'" + input_ipaddr + "', ";
						sql += "'" + input_type + "', ";
						sql += "getdate())";
						SqlCommand cmd = new SqlCommand(sql, conn);
						int cntCmd = cmd.ExecuteNonQuery();

						if(cntCmd >= 1) Response.Write( "ok" );
						else*/ Response.Write( "fail" );

					}else if(input_type == "currency"){

						sql  = "INSERT INTO event_log(name, email, phone, ipaddr, type, regdate)";
						sql += "VALUES ('" + input_name+ "', ";
						sql += "'" + input_email + "', ";
						sql += "'', ";
						sql += "'" + input_ipaddr + "', ";
						sql += "'" + input_type + "', ";
						sql += "getdate())";
						SqlCommand cmd = new SqlCommand(sql, conn);
						int cntCmd = cmd.ExecuteNonQuery();

						if(cntCmd >= 1) Response.Write( getXml(email_param) );
						else Response.Write( "fail" );

					}else Response.Write( "over" );

				}else Response.Write( "re" );

				conn.Close();

			}else Response.Write( "fail" );

		}else{
			Response.Write("일반 웹에서는 지원하지 않습니다.");
		}
		
    }

	public string getXml(string query)
    {
        //http : // 아이피:포트 / 파일명
        string url = "http://neonfly.co.kr/mail.php";
        //쿼리를 꼭 인코딩 해주자. jsp: URLEncoder.encode, ASP: Server.URLEncode
        //PHP iconv
        //url = url + "?" + HttpUtility.UrlEncode(query);
        url = url + "?" + query;
        string getXmlData = getHtmls(url);
        return getXmlData;
    }

    private string getHtmls(string receiverURL)
    {
        //JSP: URLConnection, ASP MSXML2.serverXMLHTTP,
        // PHP fsockopen
        HttpWebRequest request = (HttpWebRequest)WebRequest.Create(receiverURL);
        //xml값을 확인하기 위해 선언
        request.ContentType = "text/xml";
        request.Method = "GET";
        HttpWebResponse response = (HttpWebResponse)request.GetResponse();
        Stream receiveStream = response.GetResponseStream();
        //넘어오는값에 따라 인코딩 해주어야 한다.
        StreamReader readStream =
                     new StreamReader(receiveStream, Encoding.GetEncoding("euc-kr"));
        string xmlResult = readStream.ReadToEnd().Trim();
        response.Close();
        readStream.Close();
        return xmlResult;
    }
}
