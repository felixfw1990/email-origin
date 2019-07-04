<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  GmailTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/02
 */
class GmailTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@gmail.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
         <div dir="ltr">
             <div dir="ltr">
                 <div class = "abc", id = "sss">回复内容</divsty>
                 <div dir="ltr"><b>this is content 1</b>
                     <div><b><u>this is content 2</u></b></div>
                 </div>
                 <br><br>
                 <div class="gmail_quote">
                     <div dir="ltr" class="gmail_attr">冯伟 &lt;<a href="mailto:felixfw1111@gmail.com">felixfw1111@gmail.com</a>&gt;
                         于2019年7月2日周二 下午5:36写道：<br></div>
                     <blockquote class="gmail_quote"
                         style="margin:0px 0px 0px 0.8ex;border-left-width:1px;border-left-style:solid;border-left-color:rgb(204,204,204);padding-left:1ex">
                         <div dir="ltr"><b>this is content 1</b>
                             <div><b><u>this is content 2</u><br></b>
                                 <div><br></div>
                             </div>
                         </div>
                     </blockquote>
                 </div>
             </div>
         </div>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'gmail_quote');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'gmail_quote');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}