using System;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Data.SqlClient;

public partial class _Default : System.Web.UI.Page 
{
    protected void Page_Load(object sender, EventArgs e)
    {
		string source = @"Server=10.107.1.40;uid=Log_User;pwd=fhrmdbwj;database=TAGTVDB";
		
		SqlConnection conn = new SqlConnection(source);
		conn.Open();
		
		SqlCommand command = new SqlCommand(@"
			DELETE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT;

		", conn);
		//command.ExecuteNonQuery();
		
		conn.Close();
		
		
		/*
		//string source = @"Data Source=localhost\sqlexpress;Initial Catalog=neonfly2;Integrated Security=True";

		string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";

		SqlConnection conn = new SqlConnection(source);
		conn.Open();

		string sql = "select * from IBK_PAGE_LOG order by IDX asc";
		SqlCommand cmd = new SqlCommand(sql, conn);

		SqlDataReader reader = cmd.ExecuteReader();

		Response.Write("<TABLE cellpadding='3' cellspacing='0' border='1' align='center'>");
		Response.Write("<TR bgcolor='#C9C9C9' align='center'>");
		Response.Write("<TD>����</TD>");
		Response.Write("<TD>�湮��</TD>");
		Response.Write("<TD>�湮�ð�</TD>");
		Response.Write("<TD>�湮��IP</TD>");
		Response.Write("<TD>OS</TD>");
		Response.Write("<TD>������</TD>");
		Response.Write("<TD>����������Ʈ</TD>");
		Response.Write("<TD>�湮������</TD>");
		Response.Write("</TR>");

		while (reader.Read())
		{
			Response.Write("<tr>");
			//for(int i = 0; i < reader.FieldCount; i++)
				Response.Write("<td>" + reader[0] + "</td>");
				Response.Write("<td>" + reader[1] + "</td>");
				Response.Write("<td>" + reader[8] + "</td>");
				Response.Write("<td>" + reader[2] + "</td>");
				Response.Write("<td>" + reader[3] + "</td>");
				Response.Write("<td>" + reader[4] + "</td>");
				Response.Write("<td>" + reader[5] + "</td>");
				Response.Write("<td>" + reader[6] + "</td>");
			Response.Write("</tr>");
		}
		

		reader.Close();
		conn.Close();
		*/
    }
}
