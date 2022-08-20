<?php
/*
 * ResetPasswordService.php
 *
 * Created by Tuan Le Anh (Developer at HIKONI Co., Ltd (https://hikoni.com)) on 05/26/2022.
 * Copyright © 2022 リノベ. All rights reserved.
 */

namespace App\Services\Admin\Auth;

use App\Repositories\PasswordReset\PasswordResetRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordService
{
    protected $passwordResetRepository;
    protected $userRepository;

    /**
     * Construct of PasswordResetRepository and BusinessUserRepository
     * @param UserRepository $passwordResetRepository
     * @param UserRepository $businessUserRepository
     */
    public function __construct(PasswordResetRepository $passwordResetRepository, UserRepository $userRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Handle reset password
     * @param array $attrs
     * @return mixed
     */
    public function handle(array $attrs)
    {
        $passwordReset = $this->passwordResetRepository->where('token', $attrs['token'])->firstOrFail();
        if ($passwordReset) {
            if (Carbon::parse($passwordReset->updated_at)->addMinutes(config('app.expire_token_password_minute'))->isPast()) {
                $passwordReset->delete();
                session()->flash('expired_url', trans('messages.fail.expired_url'));

                return view('admin_page.url_fail');
            }

            $password = Hash::make($attrs['password']);
            $user = $this->userRepository->where('email', $passwordReset->email)->firstOrFail();
            $user->update(['password' => $password]);
            $passwordReset->delete();

            if (auth()->user()) {
                Auth::logout();
            }

            return $user->email;
        }
    }
}
