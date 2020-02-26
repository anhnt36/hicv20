<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use App\Seeker;
use App\Resume;


class CvController extends Controller
{
    public function index()
    {
        $this->checkLogin();
        if(!$this->isLoggedIn) {
            return response()->redirectTo($this->redirectTo);
        }
        
        $myCvs = Resume::where('seeker_id', $this->user->id)->get();
        $view = count($myCvs) ? 'cv.mycv' : 'cv.mycv_empty';

        return response()->view($view, ['isLoggedIn' => $this->isLoggedIn, 'user' => $this->user, 'myCvs' => $myCvs]);
    }

    public function listCV()
    {
        $this->checkLogin();
        if(!$this->isLoggedIn) {
            return response()->redirectTo($this->redirectTo);
        }

        $myCvs = Resume::where('seeker_id', $this->user->id)->get();
        $view = count($myCvs) ? 'cv.listcv' : 'cv.mycv_empty';

        return response()->view($view, ['isLoggedIn' => $this->isLoggedIn, 'user' => $this->user, 'myCvs' => $myCvs]);
    }


}
