<?php namespace EmailOriginTest;

/**
 * ---------------------------------------------------------------------------------
 *  Email
 * ---------------------------------------------------------------------------------
 *
 * @author felix
 * @change 2019/07/02
 */
trait Helper
{
    // ------------------------------------------------------------------------------

    /**
     * Debug
     *
     * @param     $data
     * @param int $type
     */
    function p($data, $type = 1)
    {
        echo '<pre />';
        print_r($data);
        if ($type) exit;
    }

    // ------------------------------------------------------------------------------
    
}