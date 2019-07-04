<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  HotmailTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class HotmailTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@hotmail.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
                <style type="text/css" style="display:none;"> P {
                    margin-top: 0;
                    margin-bottom: 0;
                } </style>
            </head>
            <body dir="ltr">
            <div style="font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 12pt; color: rgb(0, 0, 0);">
                回复内容
            </div>
            <div id="appendonsend"></div>
            <div style="font-family:Calibri,Arial,Helvetica,sans-serif; font-size:12pt; color:rgb(0,0,0)">
                <b style="color: rgb(50, 49, 48); font-family: &quot;Segoe UI&quot;, &quot;Segoe UI Web (West European)&quot;, &quot;Segoe UI&quot;, -apple-system, system-ui, Roboto, &quot;Helvetica Neue&quot;, sans-serif; background-color: rgb(255, 255, 255)">content1</b><span
                style="color: rgb(50, 49, 48); font-family: &quot;Segoe UI&quot;, &quot;Segoe UI Web (West European)&quot;, &quot;Segoe UI&quot;, -apple-system, system-ui, Roboto, &quot;Helvetica Neue&quot;, sans-serif; background-color: rgb(255, 255, 255); display: inline !important"></span>
                <div style="margin: 0px; font-family: &quot;Segoe UI&quot;, &quot;Segoe UI Web (West European)&quot;, &quot;Segoe UI&quot;, -apple-system, system-ui, Roboto, &quot;Helvetica Neue&quot;, sans-serif; color: rgb(50, 49, 48); background-color: rgb(255, 255, 255)">
                    <i><u style="background-color: rgb(255, 0, 0)">content2</u></i></div>
                <br>
            </div>
            <hr tabindex="-1" style="display:inline-block; width:98%">
            <div id="divRplyFwdMsg" dir="ltr"><font face="Calibri, sans-serif" color="#000000" style="font-size:11pt"><b>From:</b>
                冯伟 &lt;felixfw1111@gmail.com&gt;<br>
                <b>Sent:</b> Tuesday, July 2, 2019 5:43 PM<br>
                <b>To:</b> felixfw1111@hotmail.com<br>
                <b>Subject:</b> gmail to hotmail</font>
                <div>&nbsp;</div>
            </div>
            <div>
                <div dir="ltr"><b>content1</b>
                    <div><i><u style="background-color:rgb(255,0,0)">content2</u></i></div>
                </div>
            </div>
            </body>
        </html>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'style="display:inline-block; width:98%"' );
        $this->assertEmpty($result);

        $result = strstr($result, 'divRplyFwdMsg' );
        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'style="display:inline-block; width:98%"' );
        $this->assertNotEmpty($result);

        $result = strstr($result, 'divRplyFwdMsg' );
        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}