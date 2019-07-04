<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Gmx
 * ---------------------------------------------------------------------------------
 *
 * name = quote 的 div 以及内部内容
 *
 * @author felix
 * @change 2019/07/03
 */
class Gmx extends Abs
{
    // ------------------------------------------------------------------------------

    /**
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

            $tClassName = $this->getAtts($attributes, 'name');

            if (strstr($tClassName, 'quote') !== false)
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
        return "{$html}<div name=\"quote\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------
}