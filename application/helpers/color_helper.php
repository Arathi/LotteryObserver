<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Color Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		UND Software Foundation
 */

// ------------------------------------------------------------------------

if ( ! function_exists('xml_convert'))
{
    /**
     * Get Random Color
     *
     * @return	string
     */
    function random_color($rmin = 0, $rmax = 255, $gmin = 0, $gmax = 255, $bmin = 0, $bmax = 255)
    {
        $red = mt_rand($rmin,$rmax);
        $green = mt_rand($gmin,$gmax);
        $blue = mt_rand($bmin,$bmax);
        $color_dec = ($red<<16) + ($green<<8) + $blue;
        $hex = dechex($color_dec);
        $color_str = "#";
        for ($len = strlen($hex); $len<6; $len++)
            $color_str .= '0';
        $color_str .= $hex;
        return $color_str;
    }
}
