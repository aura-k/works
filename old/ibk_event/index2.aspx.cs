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

public partial class www_index2 : System.Web.UI.Page
{	
	public string hidden0 = "";
	public string hidden1 = "";
	public string hidden2 = "";
	public string hidden3 = "";
	public string hidden4 = "";
	public string hidden5 = "";
	public string ActionJS = "";

	public string hourPop = "";
    
	public string isAn = "";
	public string isAdd = "";

	protected void Page_Load(object sender, EventArgs e)
    {
		  if(Request["logic"] == "0"){
			  hidden0 = "style=\"display:none;\"";
			  hidden1 = "style=\"display:none;\"";
			  hidden2 = "style=\"display:none;\"";
			  hidden3 = "style=\"display:none;\"";
			  hidden4 = "style=\"display:none;\"";
			  ActionJS = "showBG();nextLogic2('0', '8');";
		  }else if(Request["logic"] == "1"){
			  hidden0 = "style=\"display:none;\"";
			  hidden1 = "style=\"display:none;\"";
			  hidden2 = "style=\"display:none;\"";
			  hidden3 = "style=\"display:none;\"";
			  hidden4 = "style=\"display:none;\"";
			  ActionJS = "showBG();nextLogic2('1', '8');";
		  }else if(Request["logic"] == "2"){
			  hidden0 = "style=\"display:none;\"";
			  hidden1 = "style=\"display:none;\"";
			  hidden2 = "style=\"display:none;\"";
			  hidden3 = "style=\"display:none;\"";
			  hidden4 = "style=\"display:none;\"";
			  ActionJS = "showBG();nextLogic2('2', '8');";
		  }else if(Request["logic"] == "3"){
			  hidden0 = "style=\"display:none;\"";
			  hidden1 = "style=\"display:none;\"";
			  hidden2 = "style=\"display:none;\"";
			  hidden3 = "style=\"display:none;\"";
			  hidden4 = "style=\"display:none;\"";
			  ActionJS = "showBG();nextLogic2('3', '8');";
		  }

		 if(Request.UserAgent.IndexOf("Android") > -1){
			  isAn = "_an";
			  isAdd = "_add";
		 }
		int nowHour = int.Parse(DateTime.Now.ToString("HH"));
        if (nowHour >= 0 && nowHour < 8)
        {
			hourPop = "2";
        }
		 
    }
}
