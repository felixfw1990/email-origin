<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Netease
 * ---------------------------------------------------------------------------------
 *
 * blockquote id = 'isReplyContent'以内内容
 * 删除内容：
 * At 2019-07-04 11:20:38, "冯伟" <felixfw1111@gmail.com> wrote:
 *
 * @author felix
 * @change 2019/07/04
 */
class Netease extends Abs
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
        $block = $dom->getElementsByTagName('blockquote');

        for ($i = 0; $i < $block->length; $i ++)
        {
            $temp       = $block->item($i);
            $attributes = $temp->attributes;

            $tClassName = $this->getAtts($attributes, 'id');

            if (strstr($tClassName, 'isReplyContent') !== false)
            {
                $parent = $temp->parentNode;
                $parent->removeChild($temp);
            }
        }

        $result = $dom->C14N();

        //clear at
        $result = preg_replace ("/At.*wrote:/", '', $result);

        return $result;
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
        "{$html}\n<br><br><br>
        <blockquote id=\"isReplyContent\" style=\"PADDING-LEFT: 1ex; MARGIN: 0px 0px 0px 0.8ex; BORDER-LEFT: #ccc 1px solid\">
        {$originHtml}
        </blockquote>";
    }

    // ------------------------------------------------------------------------------
}