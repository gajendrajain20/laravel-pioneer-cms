<?php
namespace Modules\Frontend\Http;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helpers
 *
 * @author admin
 */
class helpers {

    static public function truncate_html($s, $l, $e = '', $isHTML = true) {
        $s = trim($s);
        $e = (strlen(strip_tags($s)) > $l) ? $e : '';
        $i = 0;
        $tags = array();

        if ($isHTML) {
            preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach ($m as $o) {
                if ($o[0][1] - $i >= $l) {
                    break;
                }
                $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                if ($t[0] != '/') {
                    $tags[] = $t;
                } elseif (end($tags) == substr($t, 1)) {
                    array_pop($tags);
                }
                $i += $o[1][1] - $o[0][1];
            }
        }
        $output = mb_substr($s, 0, $l = min(strlen($s), $l + $i),"utf-8") . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . $e;
        return $output;
    }
    
    /**
     * Get admin asset url.
     *
     * @param string $url
     * @param bool   $secure
     *
     * @return string
     */
    static public function frontend_asset($url, $secure = false)
   	{
   		return asset('./../resources/views/modules/frontend/'.$url, $secure);
   	}
   

}
