<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  YandexTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class YandexTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@yandex.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <div>回复内容</div>
        <div>
            <b style="background-color:rgb( 255 , 255 , 255 );color:rgb( 0 , 0 , 0 );font-family:\'arial\' , sans-serif;font-size:15px;font-style:normal;text-decoration-style:initial;text-transform:none;white-space:normal;word-spacing:0px">content1</b>
            <div style="background-color:rgb( 255 , 255 , 255 );color:rgb( 0 , 0 , 0 );font-family:\'arial\' , sans-serif;font-size:15px;font-style:normal;font-weight:400;text-decoration-style:initial;text-transform:none;white-space:normal;word-spacing:0px">
                <i><u style="background-color:rgb( 255 , 0 , 0 )">content2</u></i></div>
        </div>
        <div><br /></div>
        <div><br /></div>
        <div>03.07.2019, 10:27, "冯伟" &lt;felixfw1111@gmail.com&gt;:</div>
        <blockquote>
            <div dir="ltr"><b>content1</b>
                <div><i><u style="background-color:rgb( 255 , 0 , 0 )">content2</u></i></div>
            </div>
        </blockquote>
        ';

        $result = $this->email->getContent($html, $this->from);
        $result = strstr($result, "<blockquote>");

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);
        $result = strstr($result, "<blockquote>");

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}