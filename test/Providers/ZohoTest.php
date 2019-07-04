<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  ZohoTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class ZohoTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@zoho.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
        <html>
        <head>
            <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
        </head>
        <body>
        <div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt;">
            <div>回复内容<br></div>
            <div class="zmail_extra" style="">
                <blockquote style="border-left: 1px solid rgb(204, 204, 204); padding-left: 6px; margin: 0px 0px 0px 5px;">
                    <div>
                        <div dir="ltr"><b>content1</b>
                            <div><i><u style="background-color:rgb(255,0,0);">content2</u></i><br></div>
                        </div>
                    </div>
                </blockquote>
            </div>
            <br>
            <div id="Zm-_Id_-Sgn"><p style=""><span class="colour" style="color:rgb(42, 42, 42)">使用<a target="_blank"
                href="https://www.zoho.com.cn/mail/"
                style="color:#598fde;">Zoho Mail</a>发送</span><br></p></div>
            <br>
            <div style="" class="zmail_extra"><br>
                <div id="Zm-_Id_-Sgn1">---- 在 星期二, 02 七月 2019 17:55:32 +0800 <b>冯伟 &lt;felixfw1111@gmail.com&gt;</b> 撰写 ----<br>
                </div>
                <br>
                <blockquote style="border-left: 1px solid rgb(204, 204, 204); padding-left: 6px; margin: 0px 0px 0px 5px;">
                    <div>
                        <div dir="ltr"><b>content1</b>
                            <div><i><u style="background-color:rgb(255,0,0);">content2</u></i><br></div>
                        </div>
                    </div>
                </blockquote>
            </div>
            <div><br></div>
        </div>
        <br></body>
        </html>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'class="zmail_extra"');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'class="zmail_extra"');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}