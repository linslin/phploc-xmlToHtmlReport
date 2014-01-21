<?php 
/**
 * PHPLOC xmlToHtmlReport converter - functions lib
 * 
 * @category  PHPLOC-xmlToHtmlReport
 * @package   xmlToHtmlReport
 * @author    Nils Gajsek <nils.gajsek@glanzkinder.com>
 * @copyright 2013-2014 Nils Gajsek
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   0.1
 * @link      https://github.com/linslin
 * 
 */
if (!function_exists('recurse_copy')) {
    function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    } 
}
if (!function_exists('xml2array_parse')) {
    function xml2array_parse($xml){
        foreach ($xml->children() as $parent => $child){
            $return["$parent"] = xml2array_parse($child)?xml2array_parse($child):"$child";
        }
        return $return;
    }
}
