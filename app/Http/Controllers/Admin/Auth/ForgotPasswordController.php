<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\Auth\ForgotPasswordService;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /**
     * Show link request form
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('admin_page.auths.forgot_password');
    }

    /**
     * Send reset link email
     *
     * @param ForgotPasswordRequest $request
     * @param ForgotPasswordService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request, ForgotPasswordService $service)
    {
        $attrs = $request->validated();

        $service->handle($attrs);

        return view('admin_page.auths.resend_email', ['email' => $request->email]);
    }

    /**
     * Handle resend mail to reset password
     *
     * @param Request $request
     * @param ForgotPasswordService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resendMail(Request $request, ForgotPasswordService $service)
    {
        $attrs = $request->all();

        $service->handleResendMail($attrs);

        return view('admin_page.auths.resend_email', ['email' => $request->email]);
    }
}
