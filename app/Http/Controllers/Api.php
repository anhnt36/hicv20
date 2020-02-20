<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Api extends Controller
{
    /**
     * Kiểm tra IP hợp lệ.
     *
     * @return void
     */
    public function __construct()
    {
        $allowIp = array(
            '127.0.0.1'
        );
        $clientIp = request()->ip();
        if (!in_array($clientIp, $allowIp)) {
            die('Access Denied');
        }
    }
}
