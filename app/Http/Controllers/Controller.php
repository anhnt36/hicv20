<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class Controller extends BaseController
{
    protected $redirectTo = '/';
    protected $user = null;
    protected $isLoggedIn = false;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('hicvauth');
    }

    public function checkLogin()
    {
        $user = Auth::user();
        if (!$user) {
            $user = new \stdClass();
        }
        $this->user = $user;
        $isLoggedIn = Auth::check() ? true : false;
        $this->isLoggedIn = $isLoggedIn;
    }
}
