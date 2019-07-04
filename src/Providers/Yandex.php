<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Yandex
 * ---------------------------------------------------------------------------------
 *
 * 标签blockquote 自己以及以内，以及上一条div
 *
 * @author felix
 * @change 2019/07/03
 */
class Yandex extends Abs
{
    // ------------------------------------------------------------------------------

    /**
     *  get handle content
     *
     * @param \DOMDocument $dom
     * @return string
     */
    protected function getHandleContent(DOMDocument $dom): string
    {
        $blocks = $dom->getElementsByTagName('blockquote');

        $temp = $blocks->item(0);

        //删除blockquote
        $parent = $temp->parentNode;
        $parent->removeChild($temp);

        //删除最后一个div
        $divs = $dom->getElementsByTagName('div');
        $lastDiv = $divs->item($divs->length - 1);

        $parent = $lastDiv->parentNode;
        $parent->removeChild($lastDiv);

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
        return "{$html}<blockquote>{$originHtml}</blockquote>";
    }

    // ------------------------------------------------------------------------------
}