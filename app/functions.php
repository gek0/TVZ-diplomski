<?php

/**
 * calculate script execution time
 */
function runtime_calc($end_time, $start_time) {
    return round($end_time - $start_time, 5);
}

/**
 * @param string $route
 * @param string $text
 * @param string $icon
 * @return HTML tag as string
 * link with active route state
 */
HTML::macro('smartRoute_link', function($route, $text, $icon = '') {
    if(Request::is($route) || Request::is($route.'/*')) {
        $active = " class='active'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'><a href="'.url($route).'">'.$icon.' '.$text.'</a></li>';
});

/**
 * @param int $length
 * @return string
 * generate random string - default 10 chars
 */
function random_string($length = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $random_string;
}

/**
 * @param int $length
 * @return string
 * generate random number string - default 10 chars
 */
function random_number_string($length = 10) {
    $chars = '0123456789';
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $random_string;
}

/**
 * @param $string
 * @return string
 * safe name, no croatian letters
 */
function safe_name($string) {
    $string = preg_replace('/&scaron;/', 's', $string);   //'š' letter fix
    $string = preg_replace('/&quot;/', '', $string);   //'"' double quote fix
    $string = preg_replace('/&#039;/', '', $string);   //''' single quote fix
    $trans = ["š" => "s", "ć" => "c", "č" => "c", "đ" => "d", "ž" => "z", " " => "_", ">" => "", "<" => "", "." => "", "," => ""];

    return strtr(mb_strtolower($string, "UTF-8"), $trans);
}