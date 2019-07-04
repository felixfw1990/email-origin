<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  GmxTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class GmxTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@gmx.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        &#22238;&#22797;&#20869;&#23481;<br />
        content1<br />
        content2<br>
        <br>
        <div name="quote"
            style=\'margin:10px 5px 5px 10px; padding: 10px 0 10px 10px; border-left:2px solid #C3D9E5; word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;\'>
            <div style="margin:0 0 10px 0;">
                <b>Sent:</b>&nbsp;Tuesday, July 02, 2019 at 6:15 PM<br />
                <b>From:</b>&nbsp;&quot;冯伟&quot; &lt;felixfw1111@gmail.com&gt;<br />
                <b>To:</b>&nbsp;felixfw1111@gmx.com<br />
        
                <b>Subject:</b>&nbsp;gmail to gmx
            </div>
            <div name="quoted-content">
                <div><b>content1</b>
                    <div><i><u style="background-color: rgb(255,0,0);">content2</u></i></div>
                </div>
        
            </div>
        </div>
        <br />
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'name="quote"');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'name="quote"');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}