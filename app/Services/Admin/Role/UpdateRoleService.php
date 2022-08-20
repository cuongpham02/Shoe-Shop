<?php

namespace App\Services\Admin\Role;

use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;

class UpdateRoleService
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
     * @param $attributes
     * @return mixed
     */
    public function handle($id, $attributes, $permissions)
    {
        if (isset($attributes)) {
            $role = $this->repository->findorfail($id);
            try {
                DB::beginTransaction();
                $role->update($attributes);
                $role->permission()->detach();
                $role->permission()->attach($permissions);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }

        return $role;
    }
}
