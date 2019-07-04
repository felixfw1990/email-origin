<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  SinaTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/04
 */
class SinaTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@sina.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        回复内容<br />content1<br />content2<br />
        <div id="origbody">
            <div style="background: #f2f2f2;">----- 原始邮件 -----<br />发件人：冯伟 &lt;felixfw1111@gmail.com&gt;<br />收件人：felixfw1111@sina.com<br />主题：gmail
                to sina<br />日期：2019年07月04日 11点27分<br /></div>
            <br />
            <div dir="ltr"><b>content1</b>
                <div><i><u style="background-color:rgb(255,0,0)">content2</u></i></div>
            </div>
        
        </div>
        ';

        $result = $this->email->getContent($html, $this->from);
        $result = strstr($result, 'origbody');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);
        $result = strstr($result, 'origbody');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}