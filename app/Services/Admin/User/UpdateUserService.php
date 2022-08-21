<?php

namespace App\Services\Admin\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

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

    public function handle($id, $attributes, $roles)
    {
        if (isset($attributes)) {
            try {
                DB::beginTransaction();
                $role = $this->repository->update($id, $attributes);
                $role->roles()->detach();
                $role->roles()->attach($roles);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }
    }
}
