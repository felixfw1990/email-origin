<?php namespace EmailOriginTest\Providers;

use EmailOriginTest\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  YahooTest
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/03
 */
class YahooTest extends Abs
{
    // ------------------------------------------------------------------------------

    private $from = 'felixfw1111@yahoo.com';

    // ------------------------------------------------------------------------------

    public function testGetMa()
    {
        $html = '
        <html>
        <head></head>
        <body>
        <div class="ydp4ec1323dyahoo-style-wrap"
            style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-size:16px;">
            <div></div>
            <div><br></div>
            <div dir="ltr" data-setdir="false">回复内容</div>
            <div dir="ltr" data-setdir="false">
                <div>
                    <div data-test-id="message-view-body" class="ydp7263f265I_52qC ydp7263f265D_FY">
                        <div class="ydp7263f265msg-body ydp7263f265P_wpofO ydp7263f265iy_A"
                            data-test-id="message-view-body-content">
                            <div class="ydp7263f265jb_0 ydp7263f265X_6MGW ydp7263f265N_6Fd5">
                                <div id="ydp7263f265yiv3306508764">
                                    <div dir="ltr"><b>content1</b>
                                        <div><i><u style="background-color: rgb(255, 0, 0);">content2</u></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ydp7263f265jb_0 ydp7263f265X_6MGW ydp7263f265N_6Fd5"></div>
                    </div>
                    <div class="ydp7263f265H_7jIs ydp7263f265D_F ydp7263f265ab_C ydp7263f265Q_69H5 ydp7263f265E_36RhU"
                        data-test-id="toolbar-hover-area">
                        <div class="ydp7263f265D_F ydp7263f265W_6D6F ydp7263f265r_BN ydp7263f265gl_C"
                            data-test-id="card-toolbar"
                            style="width: 903.406px;"></div>
                    </div>
                </div>
                <br></div>
        
        </div>
        <div id="yahoo_quoted_2158811873" class="yahoo_quoted">
            <div style="font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:13px;color:#26282a;">
        
                <div>
                    冯伟 (&lt;felixfw1111@gmail.com&gt;) 在 2019年7月2日星期二 下午05:48:53 [GMT+8] 寫道：
                </div>
                <div><br></div>
                <div><br></div>
                <div>
                    <div id="yiv3306508764">
                        <div dir="ltr"><b>content1</b>
                            <div><i><u style="background-color:rgb(255,0,0);">content2</u></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>
        ';

        $result = $this->email->getContent($html, $this->from);

        $result = strstr($result, 'yahoo_quoted');

        $this->assertEmpty($result);
    }

    // ------------------------------------------------------------------------------

    public function testSetMa()
    {
        $result = $this->email->setContent('abc', 'def', $this->from);
        $result = strstr($result, 'yahoo_quoted');

        $this->assertNotEmpty($result);
    }

    // ------------------------------------------------------------------------------
    
}