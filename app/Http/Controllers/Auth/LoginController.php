<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MenuRol;
use App\Models\PermisoRol;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $idRol = Auth::user()->idRol;
            $permisos = PermisoRol::join('permisos', 'permisos.id', '=', 'permiso_rol.idPermiso')
                ->select('permisos.*')->where('permiso_rol.idRol', '=', $idRol)->get();
            $menus = MenuRol::join('menu', 'menu.id', '=', 'menu_rol.idMenu')
                ->select('menu.*')->where('menu_rol.idRol', '=', $idRol)->get();
            session(["permisos" => $permisos, "menus" => $menus]);
            return redirect('/compras')->with('success', 'Sesión iniciada');
        }
        return $this->sendFailedLoginResponse($request);
    }

    
//     if (method_exists($this, 'hasTooManyLoginAttempts') &&
//     $this->hasTooManyLoginAttempts($request)) {
//     $this->fireLockoutEvent($request);
//     return $this->sendLockoutResponse($request);
// }

// if ($this->attemptLogin($request)) {
//     return $this->sendLoginResponse($request);
// }

// $this->incrementLoginAttempts($request);

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // protected function attemptLogin(Request $request)
    // {
    //     return $this->guard()->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }

    // protected function credentials(Request $request)
    // {
    //     return $request->only($this->username(), 'password');
    // }

    // protected function sendLoginResponse(Request $request)
    // {
    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     if ($response = $this->authenticated($request, $this->guard()->user())) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //                 ? new JsonResponse([], 204)
    //                 : redirect()->intended($this->redirectPath());
    // }

    // protected function authenticated(Request $request, $user)
    // {
    //     //
    // }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        // $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }
    // use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
