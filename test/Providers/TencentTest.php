<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  TencentTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/04
 */
class TencentTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@qq.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
       <font color="#800000" face="幼圆">回复内容</font>
       <div><b style="font-family: &quot;lucida Grande&quot;, Verdana;">content1</b>
           <div style="font-family: &quot;lucida Grande&quot;, Verdana;"><i><u style="background-color: rgb(255, 0, 0);">contnet2</u></i>
           </div>
       </div>
       <div><br></div>
       <div><br></div>
       <div style="font-size: 12px;font-family: Arial Narrow;padding:2px 0 2px 0;">------------------&nbsp;原始邮件&nbsp;------------------</div>
       <div style="font-size: 12px;background:#efefef;padding:8px;">
           <div><b>发件人:</b> "felixfw1111"&lt;felixfw1111@gmail.com&gt;;</div>
           <div><b>发送时间:</b> 2019年7月4日(星期四) 中午11:18</div>
           <div><b>收件人:</b> "IT贫民"&lt;758185812@qq.com&gt;;</div>
           <div><b>主题:</b> gmail to tencent</div>
       </div>
       <div><br></div>
       <div dir="ltr"><b>content1</b>
           <div><i><u style="background-color:rgb(255,0,0)">contnet2</u></i></div>
       </div>
       
       <style type="text/css">.qmbox style, .qmbox script, .qmbox head, .qmbox link, .qmbox meta {
           display: none !important;
       }</style> 
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, '------------------');
        $this->assertEmpty($result);

        $result  = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, 'font-size:12px;font-family:ArialNarrow;padding:2px02px0;');
        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $ck = strstr($result, '------------------');
        $this->assertNotEmpty($ck);

        $result  = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, 'font-size:12px;font-family:ArialNarrow;padding:2px02px0;');
        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}