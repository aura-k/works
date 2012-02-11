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

public partial class confirm_check_sms : System.Web.UI.Page
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
		
		myPhone = GetStringValue("SELECT APPLICANT_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		
		friend1Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_1_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		friend2Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_2_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		friend3Confirmed = GetStringValue("SELECT CASE WHEN (FRIEND_3_NAME IS NULL) THEN 'no' ELSE 'yes' END FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		
		friend1Phone = GetStringValue("SELECT FRIEND_1_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		friend2Phone = GetStringValue("SELECT FRIEND_2_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		friend3Phone = GetStringValue("SELECT FRIEND_3_PHONE FROM TAGTVDB.dbo.IBK_JTBEVENT_APPLICANT (NOLOCK) WHERE APPLICANT_SRL = @SRL", "@SRL", Request["srl"], 0);
		
		string smsBody = "IBK스마트일촌이벤트 아직도 참여 안했구나? 같이 해외여행 가자구~! http://bit.ly/el5m7A";
		
		if (friend1Confirmed == "no")
		{
			SendSMS(myPhone, friend1Phone, smsBody);
		}
		
		if (friend2Confirmed == "no")
		{
			SendSMS(myPhone, friend2Phone, smsBody);
		}
		
		if (friend3Confirmed == "no")
		{
			SendSMS(myPhone, friend3Phone, smsBody);
		}
	}
	
	public void SendSMS(string from, string to, string body)
	{
		SqlConnection conn = new SqlConnection(source);
		conn.Open();
		
		SqlCommand command;
		
		command = new SqlCommand(@"EXEC TAGTVDB.dbo.uSP_SMS_Send @FROM, @TO, @BODY;", conn);
					
		command.Parameters.Add("@FROM", SqlDbType.VarChar);
		command.Parameters["@FROM"].Value = from;
		
		command.Parameters.Add("@TO", SqlDbType.VarChar);
		command.Parameters["@TO"].Value = to;
		
		command.Parameters.Add("@BODY", SqlDbType.VarChar);
		command.Parameters["@BODY"].Value = body;
					
		int result = command.ExecuteNonQuery();
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
