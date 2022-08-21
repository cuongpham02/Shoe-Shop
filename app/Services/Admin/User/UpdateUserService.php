<?php

namespace App\Services\Admin\User;

use App\Repositories\User\UserRepository;

class UpdateUserService
{
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($attrs)
    {

    }
}
