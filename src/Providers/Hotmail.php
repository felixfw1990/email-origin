<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Hotmail
 * ---------------------------------------------------------------------------------
 *
 * <hr tabindex="-1" style="display:inline-block; width:98%"> 以下内容为引用
 *
 * class 为 divRplyFwdMsg 以下内容为引用
 *
 * @author felix
 * @change 2019/07/03
 */
class Hotmail extends Abs
{

    // ------------------------------------------------------------------------------

    /**
     * get handle content
     *
     * @param \DOMDocument $dom
     * @return string
     */
    protected function getHandleContent(DOMDocument $dom):string
    {
        $dom = $this->getCleanDiv($dom);
        $dom = $this->getCleanHr($dom);

        return $dom->C14N();
    }

    // ------------------------------------------------------------------------------

    /**
     * set handle content
     *
     * @param string $html
     * @param string $originHtml
     * @return string
     */
    protected function setHandleContent(string $html, string $originHtml): string
    {
        return
        "{$html}
        <hr tabindex=\"-1\" style=\"display:inline-block; width:98%\">
        <div id=\"divRplyFwdMsg\" dir=\"ltr\">{$originHtml}</div>";
    }


    // ------------------------------------------------------------------------------

    /**
     * get clean div
     *
     * @param \DOMDocument $dom
     * @return \DOMDocument
     */
    private function getCleanDiv(DOMDocument $dom):DOMDocument
    {
        $divs = $dom->getElementsByTagName('div');

        for ($i = 0; $i < $divs->length; $i ++)
        {
            $temp       = $divs->item($i);
            $tClassName = $this->getAtts($temp->attributes, 'id');

            if (strstr($tClassName, 'divRplyFwdMsg') !== false)
            {
                // check last div
                $lastTemp = $divs->item($i+1);

                if ($lastTemp)
                {
                    $parent = $lastTemp->parentNode;
                    $parent->removeChild($lastTemp);

                    $i--;

                    continue;
                }

                $parent = $temp->parentNode;
                $parent->removeChild($temp);
            }
        }

        return $dom;
    }

    // ------------------------------------------------------------------------------

    /**
     * get clean hr
     *
     * @param \DOMDocument $dom
     * @return \DOMDocument
     */
    private function getCleanHr(DOMDocument $dom):DOMDocument
    {
        $hr = $dom->getElementsByTagName('hr');

        for ($i = 0; $i < $hr->length; $i ++)
        {
            $temp   = $hr->item($i);
            $tStyle = $this->getAtts($temp->attributes, 'style');
            $tTabindex = $this->getAtts($temp->attributes, 'tabindex');

            $ckStyle    = strstr($tStyle, 'display:inline-block; width:98%') !== false;
            $ckTabindex = strstr($tTabindex, '-1') !== false;

            if ($ckStyle && $ckTabindex)
            {
                $parent = $temp->parentNode;
                $parent->removeChild($temp);
            }
        }

        return $dom;
    }

    // ------------------------------------------------------------------------------
}