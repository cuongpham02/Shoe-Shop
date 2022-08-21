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
    public function handle($name_role, $permission = null)
    {
        if (isset($name_role)) {

            try {
                DB::beginTransaction();
                $role = $this->repository->create($name_role);
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

