<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Email
 * ---------------------------------------------------------------------------------
 *
 * class 等于 gmail_quote 的 div 内部为引用
 *
 * @author felix
 * @change 2019/07/02
 */
class Gmail extends Abs
{
    // ------------------------------------------------------------------------------

    /**
     * get content
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

            if (strstr($tClassName, 'gmail_quote') !== false)
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
        return "{$html}<div class = \"gmail_quote\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------
}