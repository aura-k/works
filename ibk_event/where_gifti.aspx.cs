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

public partial class www_where_gifti : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
		string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";
        string input_phone = Request["phone"];
		string order_num = "";
		SqlConnection conn = new SqlConnection(source);
        conn.Open();
        
        //폰넘버 중북검사를 위한 쿼리
        string sql = "select order_id from IBK_GIFTI_LOG where phone = '" + input_phone + "'";
        
        SqlCommand cmd = new SqlCommand(sql, conn);
        SqlDataReader reader = cmd.ExecuteReader();

       if(reader.Read())
			order_num = reader[0].ToString();
	   else order_num = "";
        reader.Close();

        string gifti_param = "CAMP_ID=M1003561&ORDER_ID=" + order_num;

        string gifti_result = getXml(gifti_param);
		Response.Write(gifti_result);
    }

    public string getXml(string query)
    {
        //http : // 아이피:포트 / 파일명
        string url = "http://cm.gifticon.com/ncmSearchCoupon.gc";
        //쿼리를 꼭 인코딩 해주자. jsp: URLEncoder.encode, ASP: Server.URLEncode
        //PHP iconv
        //url = url + "?" + HttpUtility.UrlEncode(query);
        url = url + "?" + query;
        string getXmlData = getHtmls(url);
        return getXmlData;
    }

    /**
     * 웹서버로 부터 xml 결과값을 가져온다
     * @param reciverURL 웹서버 주소
     * @return 웹서버로터의 결과 xml 값
     */
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
