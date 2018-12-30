<?php
/**
 * Created by PhpStorm.
 * User: olexii
 * Date: 12/29/18
 * Time: 8:53 PM
 */

namespace Core;


class View
{

    public function render($name, $var = '')
    {
        if(is_array($var)) {
            foreach ($var as $key => $value) {
                $$key = $value;
            }
        }
        require 'views/' . $name . '.php';
    }
}