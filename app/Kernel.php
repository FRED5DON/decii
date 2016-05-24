<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/15
 * Time: 上午12:30
 */

use Decii\App\Route;


include_once "Routes.php";

if (isset($uri)) {
    Route::redirect($uri);
}



