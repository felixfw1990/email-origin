<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Sina
 * ---------------------------------------------------------------------------------
 *
 *  div id="origbody" 以内的内容
 *
 * @author felix
 * @change 2019/07/04
 */
class Sina extends Abs
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

            $tIdName = $this->getAtts($attributes, 'id');

            if (strstr($tIdName, 'origbody') !== false)
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
        return "{$html}<div id = \"origbody\">{$originHtml}</div>";
    }

    // ------------------------------------------------------------------------------
}