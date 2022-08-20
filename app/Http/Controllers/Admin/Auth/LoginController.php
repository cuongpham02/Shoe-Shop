<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginAdminRequest;
use App\Services\Admin\Auth\LoginAdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Form Login Admin.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showFormLogin()
    {
        return view('Admin.Auth.login_admin');
    }

    /**
     * Handle Login.
     * @param LoginAdminRequest $request
     * @param LoginAdminService $loginservice
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function Login(LoginAdminRequest $request, LoginAdminService $loginservice)
    {
        $attributes = $request->validated();

        $result = $loginservice->doLogin($attributes);

        return $result;

    }

    /**
     * Handle Logout.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        if (Auth()->guard('admins')->user()) {
            Auth::guard('admins')->logout();
        }
        return redirect()->route('auth.login');
    }
}
