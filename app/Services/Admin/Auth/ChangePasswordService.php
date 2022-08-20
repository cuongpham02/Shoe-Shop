<?php
/*
 * ChangePasswordService.php
 *
 * Created by Tuan Le Anh (Developer at HIKONI Co., Ltd (https://hikoni.com)) on 05/26/2022.
 * Copyright © 2022 リノベ. All rights reserved.
 */

namespace App\Services\Auth;

use App\Repositories\BusinessUser\BusinessUserRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    /**
     * @var
     */
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle logic change password.
     * @param $attributes
     * @return mixed
     */
    public function handle($attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);

        $result = $this->repository->update($attributes, getUserId());

        return $result;
    }
}
