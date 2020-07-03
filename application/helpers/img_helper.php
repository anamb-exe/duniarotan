<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function img($text)
{
    $text = '<img src="'.base_url().'/assets/imgmenu/'.$text.'" style="width:80px;">';
    return $text;
}

?>