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
class NeteaseTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@163.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        回复内容<br>content1<br>content2<br><br>At 2019-07-04 11:20:38, "冯伟" &lt;felixfw1111@gmail.com&gt; wrote:<br>
        <blockquote id="isReplyContent" style="PADDING-LEFT: 1ex; MARGIN: 0px 0px 0px 0.8ex; BORDER-LEFT: #ccc 1px solid">
            <div dir="ltr"><b>content1</b>
                <div><i><u style="background-color:rgb(255,0,0)">content2</u></i></div>
            </div>
        </blockquote><br><br><span title="neteasefooter"><p>&nbsp;</p></span>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'isReplyContent');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'isReplyContent');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}