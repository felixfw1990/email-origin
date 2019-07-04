<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  ProtonTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class ProtonTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@proton.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <div>回复内容<br></div>
        <blockquote type="cite" class="protonmail_quote">
            <div dir="ltr">
                <div><b>content1</b><br></div>
                <div><i><u style="background-color:rgb(255,0,0)">content2</u></i><br></div>
            </div>
        </blockquote>
        <div><br></div>
        <div class="protonmail_signature_block">
            <div class="protonmail_signature_block-user protonmail_signature_block-empty"><br></div>
            <div class="protonmail_signature_block-proton">Sent with <a href="https://protonmail.com"
                target="_blank">ProtonMail</a> Secure Email.<br></div>
        </div>
        <div><br></div>
        <div>‐‐‐‐‐‐‐ Original Message ‐‐‐‐‐‐‐<br></div>
        <div> 星期二, 七月 2, 2019 6:09 晚上，冯伟 &lt;felixfw1111@gmail.com&gt; 来信：<br></div>
        <div><br></div>
        <blockquote class="protonmail_quote" type="cite">
            <div dir="ltr">
                <div><b>content1</b><br></div>
                <div><i><u style="background-color:rgb(255,0,0)">content2</u></i><br></div>
            </div>
        </blockquote>
        <div><br></div>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'protonmail_signature_block');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = strstr($result, 'protonmail_signature_block');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}