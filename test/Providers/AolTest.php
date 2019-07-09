<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  AolTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class AolTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@aol.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <div style="color:;font: 10pt Helvetica Neue;"><span style="font-family: Arial, Helvetica, sans-serif;">我的爱人</span>
          <div>
              <span style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-decoration-line: underline; font-style: italic; background-color: red;"><font
                  size="7">我爱你</font></span></div>
        
          <div><span style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-decoration-line: underline; font-style: italic; background-color: red;"><font
              size="7"><br>
        </font></span><br>
              <br>
        
              <div style="font-family:helvetica,arial;font-size:10pt;color:black">-----Original Message-----<br>
                  From: felix &lt;felixfw1111@gmail.com&gt;<br>
                  To: achankayi &lt;csdfsf@aol.com&gt;<br>
                  Sent: Wed, Jul 3, 2019 6:10 pm<br>
                  Subject: gmail to aol<br>
                  <br>
        
                  <div id="yiv5828060424">
                      <div dir="ltr"><b>content1</b>
                          <div><i><u style="background-color:rgb(255,0,0);">contnet2</u></i></div>
                      </div>
        
                  </div>
              </div>
          </div>
        </div>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, 'font-family:helvetica,arial;font-size:10pt;color:black');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);

        $result = str_replace([" ", "  ", "\t", "\n", "\r"], "", $result);
        $result = strstr($result, 'font-family:helvetica,arial;font-size:10pt;color:black');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}