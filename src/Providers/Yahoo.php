<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Yahoo
 * ---------------------------------------------------------------------------------
 *
 * class 为 yahoo_quoted 的div以内的内容为评论内容
 *
 * @author felix
 * @change 2019/07/03
 */
class Yahoo extends Abs
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
        $divs = $dom->getElementsByTagName('div');

        for ($i = 0; $i < $divs->length; $i ++)
        {
            $temp       = $divs->item($i);
            $attributes = $temp->attributes;

            $tClassName = $this->getAtts($attributes, 'class');

            if (strstr($tClassName, 'yahoo_quoted') !== false)
            {
                $parent = $temp->parentNode;
                $parent->removeChild($temp);
            }
        }

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
        return "{$html}<div class=\"yahoo_quoted\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------
}