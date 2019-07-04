<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Zoho
 * ---------------------------------------------------------------------------------
 *
 * class 等于 zmail_extra 的div内部的内容为回复内容
 *
 * @author felix
 * @change 2019/07/03
 */
class Zoho extends Abs
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

            if (strstr($tClassName, 'zmail_extra') !== false)
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
        return "{$html}<div class=\"zmail_extra\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------
}