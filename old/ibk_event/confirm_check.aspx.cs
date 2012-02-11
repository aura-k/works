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

public partial class confirm_check: System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
		string userAgent = Request.ServerVariables["HTTP_USER_AGENT"].ToString();
		
		if (userAgent.IndexOf("Windows") != -1)
		{
			Response.Redirect("invalid_access.html");
		}
    }
}
