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

public partial class log : System.Web.UI.Page
{
	private static string source = @"Server=10.107.1.40;uid=Log_User;pwd=fhrmdbwj;database=TAGTVDB";

    protected void Page_Load(object sender, EventArgs e)
    {
		string sql = "";
		
		SqlConnection conn = new SqlConnection(source);
		conn.Open();
		
		SqlCommand cmd = new SqlCommand(sql, conn);
		cmd.ExecuteNonQuery();
		
		conn.Close();
    }
}
