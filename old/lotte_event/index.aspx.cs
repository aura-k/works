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

public partial class dhevent : System.Web.UI.Page
{
	public int rand_num = 1;
	public int print_value = 0;

    protected void Page_Load(object sender, EventArgs e)
    {
		//if(true) return;

		string source = @"Server=10.107.1.20;uid=DM_User;pwd=P@ssw0rd10;database=TAGTV";
		string input_ipaddr = Request.UserHostAddress;
		string sql = "";
		SqlConnection conn = new SqlConnection(source);
		SqlCommand cmdTodayCnt = null;

		conn.Open();
		
		sql = "SELECT count(no) FROM dhevent_log";
		cmdTodayCnt = new SqlCommand(sql, conn);
		SqlDataReader reader = cmdTodayCnt.ExecuteReader();
		reader.Read();
		int todayCnt = int.Parse(reader[0].ToString())+1;
		reader.Close();

		if(todayCnt == 1 || todayCnt == 3) print_value = 1;
		else if(todayCnt == 5 || todayCnt == 7) print_value = 2;
		else if(todayCnt == 9 || todayCnt == 11) print_value = 3;
		else if(todayCnt == 13 || todayCnt == 15) print_value = 4;
		else if(todayCnt == 17 || todayCnt == 19) print_value = 5;
		
		sql  = "INSERT INTO dhevent_log(ipaddr, type, regdate)";
		sql += "VALUES (";
		sql += "'" + input_ipaddr + "', ";
		sql += "'" + print_value + "', ";
		sql += "getdate())";
		SqlCommand cmd = new SqlCommand(sql, conn);
		cmd.ExecuteNonQuery();
		
		conn.Close();
    }
}
