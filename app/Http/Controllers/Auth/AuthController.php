<?php
/**
 * Created by PhpStorm.
 * User: Van Nguyen
 * Date: 1/20/2017
 * Time: 3:31 PM
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Seeker;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->asPopup()->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true); // Remember login

        return response()->redirectTo($this->redirectTo);
    }

    public function apiHandleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true); // Remember login
        return response()->redirectTo($this->redirectTo);
    }

    public function apiLoginBySocial(Request $request, $provider) {
        $user = Socialite::driver($provider)->userFromToken($request['token']);
        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);
        $currentUser = [
            'id' => Auth::user()->id,
            'email' => Auth::user()->email,
        ];
        if($user) {
            return response()->json(['status' => 1, 'message' => 'Bạn đã đăng nhập thành công !', 'user' => $currentUser]);
        } else {
            return response()->json(['status' => -1, 'message' => 'Đăng nhập bị lỗi !']);
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $providerId = '';
        switch ($provider) {
            case 'facebook':
                $providerId = "facebook_id";
                break;
            case 'linkedin':
                $providerId = "linkedin_id";
                break;
            case 'google':
                $providerId = "google_id";
                break;

        }
        if($providerId != "") {
            $authUser = Seeker::where($providerId, $user->id)->first();
            if ($authUser) {
                $authUser->logined_at = time();
                $authUser->save();
                return $authUser;
            }
            $authUser = Seeker::where('email', $user->email)->first();
            if(!$authUser) {
                return Seeker::create([
                    'fullname'     => $user->name,
                    'email'    => $user->email,
                    $providerId => $user->id,
                    'avatar' => $user->avatar,
                    'status' => 1,
                    'login_at' => time()
                ]);
            }
            if ($authUser) {
                $authUser->{$providerId} = $user->id;
                $authUser->logined_at = time();
                $authUser->save();
                return $authUser;
            }

        }

    }
}