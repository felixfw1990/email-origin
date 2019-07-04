<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Proton
 * ---------------------------------------------------------------------------------
 *
 * div class = protonmail_signature_block 以下内容
 * blockquote class = protonmail_quote 以及内容
 *
 * @author felix
 * @change 2019/07/03
 */
class Proton extends Abs
{
    // ------------------------------------------------------------------------------

    /**
     * get handle content
     *
     * @param \DOMDocument $dom
     * @return string
     */
    protected function getHandleContent(DOMDocument $dom): string
    {
        $dom = $this->getCleanDiv($dom);
        $dom = $this->getCleanBlockquote($dom);

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
        <div><br></div>
        <div class=\"protonmail_signature_block\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------

    /**
     * get clean div
     *
     * @param \DOMDocument $dom
     * @return \DOMDocument
     */
    private function getCleanDiv(\DOMDocument $dom):\DOMDocument
    {
        $divs = $dom->getElementsByTagName('div');

        for ($i = 0; $i < $divs->length; $i ++)
        {
            $temp       = $divs->item($i);
            $tClassName = $this->getAtts($temp->attributes, 'class');

            if (strstr($tClassName, 'protonmail_signature_block') !== false)
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
     * get clean blockquote
     *
     * @param \DOMDocument $dom
     * @return \DOMDocument
     */
    private function getCleanBlockquote(DOMDocument $dom):DOMDocument
    {
        $blocks = $dom->getElementsByTagName('blockquote');

        for ($i = 0; $i < $blocks->length; $i ++)
        {
            if ($i === 0) { continue; }

            $temp = $blocks->item($i);
            $temp->parentNode->removeChild($temp);
        }

        return $dom;
    }

    // ------------------------------------------------------------------------------
}