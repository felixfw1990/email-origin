<?php namespace EmailOrigin;

use \EmailOrigin\Providers\Abs;

/**
 * ---------------------------------------------------------------------------------
 *  Email
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/02
 */
class Email 
{
    // ------------------------------------------------------------------------------

    private $pro =
    [
        'qq'  => 'tencent',
        '163' => 'netease',
    ];

    // ------------------------------------------------------------------------------

    /**
     * get content
     *
     * @param string $html
     * @param string $fromEmail
     * @return string
     */
    public function getContent(string $html, string $fromEmail):string
    {
        $pro = $this->getProvider($fromEmail);
        $pro = ucfirst($pro);

        $class = "\\EmailOrigin\\Providers\\".$pro;

        if (!class_exists($class)) { return $html; }

        /**@var $module Abs*/
        $module = new $class();

        return $module->getContent($html);
    }

    // ------------------------------------------------------------------------------

    /**
     * set content
     *
     * @param string $html
     * @param string $originHtml
     * @param string $fromEmail
     * @return string
     */
    public function setContent(string $html, $originHtml, string $fromEmail):string
    {
        $pro = $this->getProvider($fromEmail);
        $pro = ucfirst($pro);

        $class = "\\EmailOrigin\\Providers\\".$pro;

        if (!class_exists($class)) { return ''; }

        /**@var $module Abs*/
        $module = new $class();

        return $module->setContent($html, $originHtml);
    }

    // ------------------------------------------------------------------------------

    /**
     * get provider
     *
     * @param string $fromEmail
     * @return string
     */
    private function getProvider(string $fromEmail):string
    {
        $pattern = '/.*@(.*).com$/';
        $result  = [];

        preg_match($pattern, $fromEmail, $result);

        $len = count($result);

        $output = $len ? $result[$len - 1] : '';

        return $this->pro[$output] ?? $output;
    }
    
    // ------------------------------------------------------------------------------
    
}