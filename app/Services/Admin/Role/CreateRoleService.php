<?php

namespace App\Services\Admin\Role;

use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;

class CreateRoleService
{
    private $repository;

    /**
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create new Role.
     * @param $attributes
     * @return mixed
     */
    public function handle($attributes, $permission = null)
    {
        if (isset($attributes)) {

            try {
                DB::beginTransaction();
                $role = $this->repository->create($attributes);
                $role->permission()->attach($permission);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                \Log::error('errors:' . $exception->getMessage() . $exception->getLine());
            }
        }

        return $role;
    }
}

