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
using System.Data.SqlTypes;

public partial class confirm_check_view : System.Web.UI.Page
{
	private static string source = @"Server=10.107.1.40;uid=Log_User;pwd=fhrmdbwj;database=TAGTVDB";
	
	public string myName = "";
	public string myPhone = "";
	public string friend1Phone = "";
	public string friend2Phone = "";
	public string friend3Phone = "";
	public string friend1Confirmed = "no";
	public string friend2Confirmed = "no";
	public string friend3Confirmed = "no";
	public string srl = "0";
	
    protected void Page_Load(object sender, EventArgs e)
    {
		string userAgent = Request.ServerVariables["HTTP_USER_AGENT"].ToString();
		
		if (userAgent.IndexOf("Windows") != -1)
		{
			Response.Redirect("invalid_access.html");
		}
		
		myName = Request["name"];
		myPhone = ToReadbleNumber(Request["phone"]);
		
		srl = GetStringValue("SELECT CONVERT(VARCHAR(30), APPLICANT_SRL) FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0);
		
		friend1Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_1_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0);
		friend2Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_2_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0);
		friend3Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_3_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0);
		
		friend1Phone = ToReadbleNumber(GetStringValue("SELECT FRIEND_1_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0));
		friend2Phone = ToReadbleNumber(GetStringValue("SELECT FRIEND_2_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0));
		friend3Phone = ToReadbleNumber(GetStringValue("SELECT FRIEND_3_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_NAME = @NAME AND APPLICANT_PHONE = '" + Request["phone"] + "'", "@NAME", Request["name"], 0));
		
		if (friend1Confirmed != "yes")
		{
			friend1Confirmed = "no";
		}
		
		if (friend2Confirmed != "yes")
		{
			friend2Confirmed = "no";
		}
		
		if (friend3Confirmed != "yes")
		{
			friend3Confirmed = "no";
		}
	}
	
	protected string ToReadbleNumber(string val)
	{
		if (val.Length == 10)
		{
			return val.Substring(0, 3) + "-" + val.Substring(3, 3) + "-" + val.Substring(6,4);
		}
		else if (val.Length == 11)
		{
			return val.Substring(0, 3) + "-" + val.Substring(3, 4) + "-" + val.Substring(7,4);
		}
		else
		{
			return val;
		}
	}
	
	public string GetStringValue(string query, string parameter, string parameterValue, int fieldIndex)
	{
		SqlConnection conn = new SqlConnection(source);
		conn.Open();
		
		SqlCommand command;
		
		command = new SqlCommand(query, conn);
		command.Parameters.Add(parameter, SqlDbType.VarChar);
		command.Parameters[parameter].Value = parameterValue;
		SqlDataReader reader = command.ExecuteReader();

		
		string output = "";
		
		if (reader.Read())
		{
			output = reader.GetString(fieldIndex);
		}
		else
		{
		}
		
		conn.Close();
		
		return output;
	}
}
