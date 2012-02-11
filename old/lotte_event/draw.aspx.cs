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

public partial class www_draw : System.Web.UI.Page
{
	public int rand_num = 1;
	public string print_name = "";
	public string print_phoneType = "hidden";
	public string print_emailType = "text";
	public string print_phoneVal = "none";
	public string print_emailVal = "";
	public string print_value = "currency";

    protected void Page_Load(object sender, EventArgs e)
    {
		if(true) return;
		/*if(int.Parse(DateTime.Now.ToString("HH")) < 7) return; //7시 이전에는 기프티콘을 내보내지 않음.

		string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";
		string sql = "";
		SqlConnection conn = new SqlConnection(source);
		SqlCommand cmdTodayCnt = null;

		Random rd = new Random();
		rand_num = rd.Next(1, 31);
		conn.Open();
		
		sql = "SELECT count(no) FROM event_log WHERE type like 'gifticon%' AND convert(varchar(10), regdate, 120)='" + DateTime.Now.ToShortDateString() + "'";
		cmdTodayCnt = new SqlCommand(sql, conn);
		SqlDataReader reader = cmdTodayCnt.ExecuteReader();
		reader.Read();
		int todayCnt = int.Parse(reader[0].ToString());
		reader.Close();
		//Response.Write( todayCnt + "<br>" );
		if(todayCnt < 117){//기프티콘 총 건수가 하루 총 50건을 넘었는지 체크

			if(rand_num == 10){
				sql = "SELECT count(no) FROM event_log WHERE type = 'gifticon' AND convert(varchar(10), regdate, 120)='" + DateTime.Now.ToShortDateString() + "'";
				cmdTodayCnt = new SqlCommand(sql, conn);
				reader = cmdTodayCnt.ExecuteReader();
				reader.Read();
				todayCnt = int.Parse(reader[0].ToString());
				reader.Close();

				//Response.Write( todayCnt + "<br>" );
				if(todayCnt < 84){//기프티콘(커피) 건수가 하루 총 30건을 넘었는지 체크
					print_phoneType = "tel";
					print_emailType = "hidden";
					print_phoneVal = "";
					print_emailVal = "none";
					print_value = "gifticon";
				}
				
			}else if(rand_num == 120){
				sql = "SELECT count(no) FROM event_log WHERE type = 'gifticon_set' AND convert(varchar(10), regdate, 120)='" + DateTime.Now.ToShortDateString() + "'";
				cmdTodayCnt = new SqlCommand(sql, conn);
				reader = cmdTodayCnt.ExecuteReader();
				reader.Read();
				todayCnt = int.Parse(reader[0].ToString());
				reader.Close();
				
				//Response.Write( todayCnt + "<br>" );
				if(todayCnt < 32){//기프티콘(세트) 건수가 하루 총 20건을 넘었는지 체크
					print_phoneType = "tel";
					print_emailType = "hidden";
					print_phoneVal = "";
					print_emailVal = "none";
					print_value = "gifticon_set";
				}

			}

		}
		
		conn.Close();*/
    }
}
