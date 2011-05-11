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

public partial class test : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
		if(Request.UserHostAddress == "211.62.41.61"){
			string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";
			string sql = "";

			SqlConnection conn = new SqlConnection(source);
			conn.Open();

			sql = "SELECT * FROM event_log";
			//sql = "Truncate table event_log";
			SqlCommand cmdCheckId = new SqlCommand(sql, conn);
			SqlCommand cmd = new SqlCommand(sql, conn);

			SqlDataReader reader = cmd.ExecuteReader();

			Response.Write("<TABLE cellpadding='3' cellspacing='0' border='1' align='center'>");
			Response.Write("<TR bgcolor='#C9C9C9' align='center'>");
			Response.Write("<TD>순번</TD>");
			Response.Write("<TD>이름</TD>");
			Response.Write("<TD>이메일</TD>");
			Response.Write("<TD>폰넘버</TD>");
			Response.Write("<TD>IP</TD>");
			Response.Write("<TD>유형</TD>");
			Response.Write("<TD>등록일</TD>");
			Response.Write("</TR>");

			while (reader.Read())
			{
				Response.Write("<tr>");
				//for(int i = 0; i < reader.FieldCount; i++)
					Response.Write("<td>" + reader[0] + "</td>");
					Response.Write("<td>" + reader[1] + "</td>");
					Response.Write("<td>" + reader[2] + "</td>");
					Response.Write("<td>" + reader[3] + "</td>");
					Response.Write("<td>" + reader[4] + "</td>");
					Response.Write("<td>" + reader[5] + "</td>");
					Response.Write("<td>" + reader[6] + "</td>");
				Response.Write("</tr>");
			}
			

			reader.Close();
			conn.Close();
		}
    }
}
