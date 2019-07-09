<?php namespace EmailOrigin\Providers;

use DOMDocument;

/**
 * ---------------------------------------------------------------------------------
 *  Tencent
 * ---------------------------------------------------------------------------------
 *
 * <div style="font-size: 12px;font-family: Arial Narrow;padding:2px 0 2px 0;">------------------&nbsp;原始邮件&nbsp;------------------</div>
 * 及其以下div内容
 *
 * @author felix
 * @change 2019/07/04
 */
class Tencent extends Abs
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

            $tStyle = $this->getAtts($attributes, 'style');
            $tStyle = str_replace([" ", "  ", "\t", "\n", "\r"], "", $tStyle);

            if (strstr($tStyle, 'font-size:12px;font-family:ArialNarrow;padding:2px02px0;') !== false)
            {
                $tempHtml = $temp->C14N();

                if (strstr($tempHtml, '------------------') !== false)
                {
                    // check last div
                    $lastTemp = $divs->item($i + 1);

                    if ($lastTemp)
                    {
                        $parent = $lastTemp->parentNode;
                        $parent->removeChild($lastTemp);

                        $i --;

                        continue;
                    }

                    $parent = $temp->parentNode;
                    $parent->removeChild($temp);
                }
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
        return "
        {$html}
        <div style=\"font-size: 12px;font-family: Arial Narrow;padding:2px 0 2px 0;\">
            ------------------&nbsp;原始邮件&nbsp;------------------
        </div> 
        <div>{$originHtml}</div>
        ";
    }

    // ------------------------------------------------------------------------------
}