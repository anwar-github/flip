<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:17
 */

spl_autoload_register(function ($class) {
    require str_replace('\\', '/', $class) . '.php';
});
