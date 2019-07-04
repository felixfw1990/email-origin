<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Icloud
 * ---------------------------------------------------------------------------------
 *
 * 标签 blockquote type = 'cite' style = '',且内部有class="msg-quote"
 * 附带删除最后两个div
 *
 * @author felix
 * @change 2019/07/03
 */
class Icloud extends Abs
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
        $existQuote = false;

        $blocks = $dom->getElementsByTagName('blockquote');

        for ($i = 0; $i < $blocks->length; $i ++)
        {
            $temp       = $blocks->item($i);
            $attributes = $temp->attributes;

            $style = $this->getAtts($attributes, 'style');
            $style = str_replace([" ", "  ", "\t", "\n", "\r"], "", $style);

            if (strstr($style, 'margin:0px') === false)
            {
                //删除非第一层目录的blockquote
                $temp->parentNode->removeChild($temp);

                $existQuote = true;
            }
        }

        if (!$existQuote) { return NULL; }

        //删除最后两个div
        $divs = $dom->getElementsByTagName('div');
        $temp = $divs->item($divs->length -1);
        $temp->parentNode->removeChild($temp);

        $divs = $dom->getElementsByTagName('div');
        $temp = $divs->item($divs->length -1);
        $temp->parentNode->removeChild($temp);

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
        "<div> <blockquote style=\"margin: 0px\">{$html}</blockquote> </div>
        <div></div>
        <div ><blockquote type=\"city\">{$originHtml}</blockquote></div>
        ";
    }

    // ------------------------------------------------------------------------------
}