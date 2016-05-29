<?php

/**
 * Decii - A PHP Framework For Virtual host
 *
 * @package  Decii
 * @author   Fred Don <gsiner@live.com>
 */

define('BASE_PATH', __DIR__);


$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
putenv('app_path=' . BASE_PATH);
// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(BASE_PATH . '/public' . $uri)) {
    return false;
}
require_once BASE_PATH . '/public/index.php';
