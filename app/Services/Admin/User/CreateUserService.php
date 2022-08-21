<?php

namespace App\Services\Admin\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

class CreateUserService
{
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($attributes, $roles)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        try {
            DB::beginTransaction();
            $users = $this->repository->create($attributes);
            $users->roles()->attach($roles);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}
