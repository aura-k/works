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

public partial class www_index : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        UserAgentTest();
    }

    private void UserAgentTest(){
        string userAgent;
        userAgent = Request.UserAgent;

        if(userAgent.IndexOf("iPhone") > -1)
        {
            Response.Redirect("index_iphone.aspx");
        }
        else if (userAgent.IndexOf("Android") > -1)
        {
            Response.Redirect("index_an.aspx");
        }
        else
        {
        }
    }
}
