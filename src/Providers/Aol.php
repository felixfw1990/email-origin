<?php namespace EmailOrigin\Providers;

use DOMDocument;
/**
 * ---------------------------------------------------------------------------------
 *  Aol
 * ---------------------------------------------------------------------------------
 *
 * div style = 'font-family:helvetica,arial;font-size:10pt;color:black' 以及以下的内容
 * 且内容里面有id = 'yiv...'字样
 *
 * @author felix
 * @change 2019/07/03
 */
class Aol extends Abs
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

            $style = $this->getAtts($attributes, 'style');
            $style = str_replace([" ", "  ", "\t", "\n", "\r"], "", $style);

            if ($style === 'font-family:helvetica,arial;font-size:10pt;color:black')
            {
                $tempHtml = $temp->C14N();

                if (strstr($tempHtml, 'yiv') === false)
                {
                    continue;
                }

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
        return
        "
        {$html}
        <div style = \"font-family:helvetica,arial;font-size:10pt;color:black\">
            <div id=\"yiv520\">{$originHtml}</div>
        </div>
        ";
    }

    // ------------------------------------------------------------------------------
}