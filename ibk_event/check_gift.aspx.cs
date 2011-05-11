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

public partial class check_gift : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";

        SqlConnection conn = new SqlConnection(source);
        conn.Open();

        string sql = "select count(no) from IBK_GIFTI_LOG where day = '" + DateTime.Now.AddHours(-8).ToString("dd") + "' and month = '" + DateTime.Now.AddHours(-8).ToString("MM") + "'";

        SqlCommand cmd = new SqlCommand(sql, conn);
        SqlDataReader reader = cmd.ExecuteReader();

        reader.Read();

        Response.Write(reader[0]);

        reader.Close();
        conn.Close();
    }
}
