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

public partial class applicant : System.Web.UI.Page
{
	private static string source = @"Server=10.107.1.40;uid=Log_User;pwd=fhrmdbwj;database=TAGTVDB";

    protected void Page_Load(object sender, EventArgs e)
    {
		Response.Write("<style>");
		Response.Write("");
		Response.Write(".head { background-color:#333333; }");
		Response.Write(".head td { color:#ffffff; text-align:center; }");
		Response.Write(".link {  }");
		Response.Write("table tr td { font-size:8pt; font-family:dotum; text-align:center; }");
		Response.Write("");
		Response.Write("</style>");
		Response.Write("<a href='?'>당일확인완료목록</a> / <a href='?mode=total'>전체응모목록</a> / <a href='?mode=confirmed'>확인완료목록</a><br /><br />");
		
		SqlConnection conn = new SqlConnection(source);
		conn.Open();
		
		string fields = @"
			 [APPLICANT_SRL]
			,[APPLICANT_NAME]
			,[APPLICANT_PHONE]
			,ISNULL([FRIEND_1_NAME], '-')
			,ISNULL([FRIEND_2_NAME], '-')
			,ISNULL([FRIEND_3_NAME], '-')
			,[FRIEND_1_PHONE]
			,[FRIEND_2_PHONE]
			,[FRIEND_3_PHONE]
			,[FRIEND_1_CONFIRM]
			,[FRIEND_2_CONFIRM]
			,[FRIEND_3_CONFIRM]
			,ISNULL(CONVERT(CHAR(19), [FRIEND_1_CONFIRM_DATE], 121), '-')
			,ISNULL(CONVERT(CHAR(19), [FRIEND_2_CONFIRM_DATE], 121), '-')
			,ISNULL(CONVERT(CHAR(19), [FRIEND_3_CONFIRM_DATE], 121), '-')
			,[INQUIRY_TOKEN]
			,[IS_PROCESSING]
			,[UPDATEDATE]
			,[SIGNDATE]
		";
		string sql;
		
		if (Request["mode"] != null && Request["mode"] == "confirmed")
		{
			sql = "SELECT " + fields + " FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE IS_PROCESSING = 0 ORDER BY IS_PROCESSING ASC, UPDATEDATE ASC";
		}
		else if (Request["mode"] != null && Request["mode"] == "total")
		{
			sql = "SELECT " + fields + " FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) ORDER BY IS_PROCESSING ASC, UPDATEDATE ASC";
		}
		else
		{
			sql = "SELECT " + fields + " FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE IS_PROCESSING = 0 AND CONVERT(CHAR(8), UPDATEDATE, 112) = CONVERT(CHAR(8), GETDATE(), 112) ORDER BY IS_PROCESSING ASC, UPDATEDATE ASC";
		}
		
		SqlCommand cmd = new SqlCommand(sql, conn);
		SqlDataReader reader = cmd.ExecuteReader();
		
		Response.Write("<table cellspacing='0' cellpadding='12' style='width:100%;'>");
		Response.Write("<tr class='head'>");
		Response.Write("<td rowspan='2'>Rank</td>");
		Response.Write("<td rowspan='2'>응모자</td>");
		Response.Write("<td rowspan='2'>연락처</td>");
		Response.Write("<td colspan='3'>친구1</td>");
		Response.Write("<td colspan='3'>친구2</td>");
		Response.Write("<td colspan='3'>친구3</td>");
		Response.Write("<td rowspan='2'>전원확인여부</td>");
		Response.Write("<td rowspan='2'>전원확인시간</td>");
		Response.Write("<td rowspan='2'>최초등록시간</td>");
		Response.Write("</tr>");
		Response.Write("<tr class='head'>");
		Response.Write("<td style='background:#444444;'>이름</td>");
		Response.Write("<td style='background:#444444;'>연락처</td>");
		Response.Write("<td style='background:#444444;'>확인시간</td>");
		Response.Write("<td style='background:#555555;'>이름</td>");
		Response.Write("<td style='background:#555555;'>연락처</td>");
		Response.Write("<td style='background:#555555;'>확인시간</td>");
		Response.Write("<td style='background:#666666;'>이름</td>");
		Response.Write("<td style='background:#666666;'>연락처</td>");
		Response.Write("<td style='background:#666666;'>확인시간</td>");
		Response.Write("</tr>");
		
		int offset = 0;
		while (reader.Read())
		{
			if ((offset++) % 2 == 0)
			{
				Response.Write("<tr style='background-color:#ffffff;'>");
			}
			else
			{
				Response.Write("<tr style='background-color:#efefef;'>");
			}
			
			WriteRow(offset);
			WriteRow(reader[1]);
			WriteRow(reader[2]);

			WriteRow(reader[3]);
			WriteRow(reader[6]);
			WriteRow(reader[12]);

			WriteRow(reader[4]);
			WriteRow(reader[7]);
			WriteRow(reader[13]);

			WriteRow(reader[5]);
			WriteRow(reader[8]);
			WriteRow(reader[14]);

			//WriteRow(reader[15]);
			if (reader[16].ToString() == "0")
			{
				WriteRow("Confirmed", "style='background-color:orange;'");
			}
			else
			{
				WriteRow("Waiting", "style='background-color:yellow;'");
			}
			if (reader[16].ToString() == "0")
			{
				WriteRow(reader[17]);
			}
			else
			{
				WriteRow("-");
			}
			WriteRow(reader[18]);
			
			Response.Write("</tr>");
			
			//Response.Write(reader[0] + " / " + reader[1] + " / " + reader[2] + " / " + reader[3] + " / " + reader[4] + " / " + reader[5] + " / " + reader[6] + " / " + reader[7] + " / " + reader[8] + " / " + reader[9] + " / " + reader[10] + " / " + reader[11] + " / " + reader[12] + " / " + reader[13] + " / " + reader[14] + " / " + reader[15] + " / " + reader[16] + " / " + reader[17] + " / " + reader[18] + "<br />");
		}
		
		Response.Write("</table>");
		Response.Write("<br />");
		Response.Write("<br />");
		Response.Write("<br />");
		
		reader.Close();
		conn.Close();
    }
	
	public void WriteRow(object value)
	{
		Response.Write("<td>");
		Response.Write(value);
		Response.Write("</td>");
	}
	
	public void WriteRow(object value, string style)
	{
		Response.Write("<td " + style + ">");
		Response.Write(value);
		Response.Write("</td>");
	}
}
