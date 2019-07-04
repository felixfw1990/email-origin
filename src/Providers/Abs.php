<?php namespace EmailOrigin\Providers;

use DOMDocument;
use DOMNamedNodeMap;

/**
 * ---------------------------------------------------------------------------------
 *  Email
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/02
 */
abstract class Abs
{

    // ------------------------------------------------------------------------------

    /**
     * get content
     *
     * @param string $html
     * @return string
     */
    public function getContent(string $html)
    {
        $codeHtml = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dom = new DOMDocument();

        @$dom->loadHTML($codeHtml);

        $result  = $this->getHandleContent($dom);

        if ($result === NULL) { return $html; }

        return $result;
    }

    // ------------------------------------------------------------------------------

    /**
     * set content
     *
     * @param string $html
     * @param string $originHtml
     * @return string
     */
    public function setContent(string $html, string $originHtml):string
    {
        return $this->setHandleContent($html, $originHtml);
    }
    // ------------------------------------------------------------------------------

    /**
     * get handle content
     *
     * @param \DOMDocument $dom
     * @return string
     */
    abstract protected function getHandleContent(DOMDocument $dom):string ;

    // ------------------------------------------------------------------------------

    /**
     * set handle content
     *
     * @param string $html
     * @param string $originHtml
     * @return string
     */
    abstract protected function setHandleContent(string $html, string $originHtml):string ;

    // ------------------------------------------------------------------------------


    /**
     * get html Property
     *
     * @param \DOMNamedNodeMap $atts
     * @param  string          $proName property key
     * @return string
     */
    protected function getAtts(DOMNamedNodeMap $atts, string $proName = 'class'):string
    {
        //$temp->getAttribute('class');

        $output = '';

        for ($i = 0; $i < $atts->length; $i ++)
        {
            $temp = $atts->item($i);
            $tempName = $temp->localName;

            if ($tempName != $proName) { continue; }

            return $temp->nodeValue;
        }

        return $output;
    }

    // ------------------------------------------------------------------------------
}