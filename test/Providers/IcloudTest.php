<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  IcloudTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class IcloudTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@icloud.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <html>
        <body>
        <div>回复内容</div>
        <div>
            <meta charset="utf-8">
            <blockquote type="cite"
                style="padding: 0px 12px; border-left: 2px solid #003399; margin: 0px; color: #003399; font-family: SFNSText, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;"
                data-mce-style="padding: 0px 12px; border-left: 2px solid #003399; margin: 0px; color: #003399; font-family: SFNSText, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;">
                <div class="msg-quote">
                    <div dir="ltr"><b>content1</b>
                        <div><i><u data-mce-style="background-color: #ff0000;" style="background-color: rgb(255, 0, 0);">content2</u></i>
                        </div>
                    </div>
                </div>
            </blockquote>
        </div>
        <div><br>2019年7月2日 上午2:59，冯伟 &lt;felixfw1111@gmail.com&gt; 写道：<br><br></div>
        <div>
            <blockquote type="cite">
                <div class="msg-quote">
                    <div dir="ltr"><b>content1</b>
                        <div><i><u style="background-color: #ff0000;"
                            data-mce-style="background-color: #ff0000;">content2</u></i></div>
                    </div>
                </div>
            </blockquote>
        </div>
        <audio controls="controls" style="display: none;"></audio>
        </body>
        </html>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, '<blockquotetype="cite">');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, '<blockquotetype="city">');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}