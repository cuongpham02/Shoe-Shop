<?php
/*
 * ForgotPasswordService.php
 *
 * Created by Tuan Le Anh (Developer at HIKONI Co., Ltd (https://hikoni.com)) on 05/26/2022.
 * Copyright © 2022 リノベ. All rights reserved.
 */

namespace App\Services\Auth;

use App\Mail\Admin\SendMailResetPasswordAdmin;
use App\Repositories\PasswordReset\PasswordResetRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ForgotPasswordService
{
    protected $passwordResetRepository;
    protected $UserRepository;

    /**
     * Construct of PasswordResetRepository and BusinessUserRepository
     * @param PasswordResetRepository $passwordResetRepository
     * @param UserRepository $businessUserRepository
     */
    public function __construct(PasswordResetRepository $passwordResetRepository, UserRepository $UserRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->UserRepository = $UserRepository;
    }

    /**
     * Handle forgot password
     *
     * @param array $attrs
     * @return mixed
     */
    public function handle(array $attrs)
    {
        $user = $this->UserRepository->where('email', $attrs['email'])->firstOrFail();

        $passwordReset = $this->passwordResetRepository->updateOrCreate([
            'email' => $user->email
        ], [
            'token' => Str::random(60)
        ]);

        if ($passwordReset) {
            $domain = FacadesRequest::root();

            $this->_handleSendMailResetPassword($attrs, $passwordReset->token, $domain);
        }

        return $user;
    }

    /**
     * Handle resend mail
     *
     * @param array $attrs
     * @return mixed
     */
    public function handleResendMail(array $attrs)
    {
        $user = $this->UserRepository->where('email', $attrs['email'])->firstOrFail();
        $passwordReset = $this->passwordResetRepository->where('email', $attrs['email'])->first();
        if ($passwordReset) {
            if (! Carbon::parse($passwordReset->updated_at)->addMinutes(env('MINUTE_WAITING_RESEND_MAIL'))->isPast()) {
                session()->forget('success');
                session()->flash('error', __('messages.fail.resend_mail_failure'));
            } else {
                session()->forget('error');
                session()->flash('success', __('messages.success.resend_mail'));
                $domain = FacadesRequest::root();
                $passwordReset->update(['token' => Str::random(60)]);

                $this->_handleSendMailResetPassword($attrs, $passwordReset->token, $domain);
            }
            return $user;
        }
        return  redirect()->route('auth.login');
    }

    /**
     * Handle send mail to reset password
     *
     * @param array $attrs
     * @param $passwordReset
     * @param $domain
     * @return void
     */
    private function _handleSendMailResetPassword(array $attrs, $token, $domain)
    {
        $mailTo = $attrs['email'];
        $attrs = [
            'url' => $domain . '/reset-password/' . $token
        ];

        Mail::to($mailTo)->send(new SendMailResetPasswordAdmin($attrs));
    }
}
