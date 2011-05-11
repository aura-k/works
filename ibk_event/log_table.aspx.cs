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
        //string source = @"Data Source=localhost\sqlexpress;Initial Catalog=neonfly2;Integrated Security=True";

        string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";

        SqlConnection conn = new SqlConnection(source);
        conn.Open();

        string sql = "select * from IBK_PAGE_LOG order by IDX asc";
        SqlCommand cmd = new SqlCommand(sql, conn);

        SqlDataReader reader = cmd.ExecuteReader();

        Response.Write("<TABLE cellpadding='3' cellspacing='0' border='1' align='center'>");
        Response.Write("<TR bgcolor='#C9C9C9' align='center'>");
        Response.Write("<TD>순번</TD>");
        Response.Write("<TD>방문일</TD>");
        Response.Write("<TD>방문시간</TD>");
        Response.Write("<TD>방문자IP</TD>");
        Response.Write("<TD>OS</TD>");
        Response.Write("<TD>브라우져</TD>");
        Response.Write("<TD>유져에이전트</TD>");
        Response.Write("<TD>방문페이지</TD>");
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
    }
}
