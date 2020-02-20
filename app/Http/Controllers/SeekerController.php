<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use App\Seeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AccessAuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\RegistersUsers;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use Illuminate\Contracts\Auth\Guard;

class SeekerController extends Controller
{
    public function index()
    {
        return "Hi! CV is comming...";
    }

    /**
     * Tải trang cung cấp các hình thức đăng nhập
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function login()
    {
        // Kiểm tra xem người dùng đăng nhập chưa. Nếu đăng nhập rồi thì chuyển về trang trước đó
        $user = Auth::user();
        if (Auth::check()) {
            return Redirect::back();
//            return redirect($this->redirectTo);
        }
        return view('profile.login');
    }

    /**
     * Tải trang cho phép người dùng đăng nhập bằng tài khoản HiCV
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function loginHicv(Request $request)
    {
        // Kiểm tra xem người dùng đăng nhập chưa. Nếu đăng nhập rồi thì chuyển về trang trước đó
        $user = Auth::user();
        if (Auth::check()) {
            return Redirect::back();
//            return redirect($this->redirectTo);
        }

        // Kiểm tra xem người dùng đã submit form qua giao thức POST không. Nếu đúng thì thực hiện việc xác thực.
        if ($request->isMethod('post')) {
            $rules = array(
                'email' => 'required|email', //Email phải đúng khuôn dạng và bắt buộc nhập
                'password' => 'required|alphaNum|min:8'); //Mật khẩu dài tối thiểu 8 ký tự dạng alphaNum, bắt buộc phải nhập

            $validator = Validator::make(Input::all(), $rules);
            //Kiểm tra thông tin người dùng nhập. Nếu không đúng rule thì gửi thông báo lỗi về
            if ($validator->fails()) {
                //Gửi thông báo lỗi validate về form, không gửi kèm thông tin mật khẩu.
                return Redirect::route('loginHicv')->withErrors($validator)
                    ->withInput(Input::except('password'));
            } else {
                //Tạo mảng thông tin đăng nhập
                $userdata = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')
                );
                //Thực hiện đăng nhập với các thông tin người dùng nhập trên form
                if (Auth::attempt($userdata)) {
                    $userLogin = Seeker::where('email', $userdata['email'])->first();
                    $userLogin->logined_at = time();
                    $userLogin->save();
                    return Redirect::to($this->redirectTo);
                } else {
                    //Thông báo lỗi không đăng nhập được và chuyển hướng về trang trước đó.
                    Session::flash('message-login', "Đăng nhập không thành công. Vui lòng kiểm tra lại Email hoặc mật khẩu.");
                    return Redirect::back();
                }
            }
        }

        return view('profile.loginhicv');
    }

    public function apiLogin(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['message' => 'Bạn đã đăng nhập thành công !', 'status' => 1]);
        }

        // Kiểm tra xem người dùng đã submit form qua giao thức POST không. Nếu đúng thì thực hiện việc xác thực.
        if ($request->isMethod('post')) {
            $rules = array(
                'email' => 'required|email', //Email phải đúng khuôn dạng và bắt buộc nhập
                'password' => 'required|alphaNum|min:8'); //Mật khẩu dài tối thiểu 8 ký tự dạng alphaNum, bắt buộc phải nhập

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                //Gửi thông báo lỗi validate về form, không gửi kèm thông tin mật khẩu.
                return response()->json(['status' => -1, 'message' => 'Email chưa đúng hoặc password chưa đúng !']);
            } else {
                //Tạo mảng thông tin đăng nhập
                $userdata = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')
                );

                if (Auth::attempt($userdata)) {
                    $userLogin = Seeker::where('email', $userdata['email'])->first();
                    $userLogin->logined_at = time();
                    $userLogin->save();
                    $user = [
                        'id' => Auth::user()->id,
                        'email' => Auth::user()->email,
                    ];

                    return response()->json(['status' => 1, 'message' => 'Bạn đã đăng nhập thành công !', 'user' => $user]);
                } else {
                    return response()->json(['status' => -1, 'message' => 'Đăng nhập không thành công. Vui lòng kiểm tra lại Email hoặc mật khẩu. !']);
                }
            }
        }

        return view('profile.loginhicv');
    }


    public function register(Request $request) {
        $model = new Seeker();
        if ($request->isMethod('post')) {
            $rules = array(
                'email' => 'required|email|unique:seeker,email', //Email phải đúng khuôn dạng và bắt buộc nhập
                'password' => 'required|alphaNum|min:8', //Mật khẩu dài tối thiểu 8 ký tự dạng alphaNum, bắt buộc phải nhập
                'repassword' => 'required|alphaNum|min:8|same:password', //Mật khẩu dài tối thiểu 8 ký tự dạng alphaNum, giống mật khẩu bên trên, bắt buộc phải nhập
                'iagree' => 'required'
                );


            $model->fill(Input::all());
            $validator = Validator::make(Input::all(), $rules, array(
                'unique' => 'Email đã tồn tại, bạn vui lòng sử dụng email khác',
                'required' => 'Bạn không được để trống dữ liệu này',
                'same' => 'Mẩu khẩu không khớp',
                'min' => 'Bạn cần nhập ít nhất :min ký tự',
            ));
            if ($validator->fails()) {
                //Gửi thông báo lỗi validate về form, không gửi kèm thông tin mật khẩu.
                return Redirect::route('register')->withErrors($validator)
                    ->withInput(Input::except(['password', 'repassword']));
            } else {
                $userdata = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                );
                Seeker::create(['email' => Input::get('email'), 'password' => Hash::make(Input::get('password')),  'status' => 1]);
                $user = Seeker::where(['email' => $userdata['email'], 'status' => 1]);
                if($user) {
                    if (Auth::attempt($userdata)) {
                        $userLogin = Seeker::where('email', $userdata['email'])->first();
                        $userLogin->logined_at = time();
                        $userLogin->save();
                        Session::flash('message-register-ok', "Chúc mừng bạn đã đăng ký thành công tài khoản trên HiCV!");
                        return Redirect::to($this->redirectTo);
                    } else {
                        //Thông báo lỗi không đăng nhập được và chuyển hướng về trang trước đó.
                        Session::flash('message-login', "Đăng nhập không thành công. Vui lòng kiểm tra lại Email hoặc mật khẩu.");
                        return Redirect::back();
                    }
                } else {
                    Session::flash('message-register', "Hệ thống không thể đăng ký tài khoản. Bạn vui lòng thử lại sau.");
                    return Redirect::back();
                }

            }

        }
        return view('profile.register')->with('model', $model);
    }

    /**
     * Đăng xuất tài khoản
     * @return Redirect
     */
    public function logout()
    {
        Auth::logout(false);
        return redirect($this->redirectTo);
    }

    public function changePassword(Request $request){
        $this->checkLogin();
        if(!$this->isLoggedIn) {
            return redirect($this->redirectTo);
        }
        if ($request->isMethod('post')) {
            $rules = array(
                'currentPassword' => 'required|alphaNum|min:8', //Mật khẩu cũ dài tối thiểu 8 ký tự dạng alphaNum, bắt buộc phải nhập
                'newPassword' => 'required|alphaNum|min:8', //Mật khẩu mới dài tối thiểu 8 ký tự dạng alphaNum, bắt buộc phải nhập
                'passwordConfirm' => 'required|alphaNum|min:8|same:newPassword', //Mật khẩu dài tối thiểu 8 ký tự dạng alphaNum, giống mật khẩu bên trên, bắt buộc phải nhập
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                //Gửi thông báo lỗi validate về form, không gửi kèm thông tin mật khẩu.
                return Redirect::route('changePassword')->withErrors($validator)
                    ->withInput(Input::except(['currentPassword', 'newPassword', 'passwordConfirm']));

            } else {
                $model = Seeker::where('email', $this->user->email)->first();
                //Kiểm tra mật khẩu hiện tại có chính xác không.
                if (Hash::check(Input::get('currentPassword'), $model->getAuthPassword())) {
                    //Nếu mật khẩu chính xác thì cập nhật mật khẩu
                    $model->password = Hash::make(Input::get('newPassword'));
                    $model->save();
                    //Gửi thông báo thay đổi mật khẩu thành công
                    Session::flash('message-change-password-ok', "Bạn đã đổi mật khẩu tài khoản HiCV thành công.");
                } else {
                    //Gửi thông báo kiểm tra mật khẩu hiện tại khi mật khẩu không chính xác
                    Session::flash('message-change-password-fail', "Bạn vui lòng kiểm tra lại mật khẩu hiện tại");
                }
                return redirect(route('changePassword'));

            }

        }
        return view("profile.changePassword", ['isLoggedIn' => $this->isLoggedIn, 'user' => $this->user]);
    }

    public function getCurrentUser() {
        if(Auth::check()) {
            $user = [
                'id' => Auth::user()->id,
                'email' => Auth::user()->email,
            ];
            return response()->json(['status' => 1, 'user' => $user]);
        }

        return response()->json(['status' => -1]);
    }
}
