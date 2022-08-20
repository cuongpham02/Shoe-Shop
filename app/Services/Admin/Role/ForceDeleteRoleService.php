<?php

namespace App\Services\Admin\Role;

use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;

class ForceDeleteRoleService
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
     * Force delete Role and Permission related.
     * @param $id
     * @return null
     */
    public function handle($id)
    {
        if (isset($id)) {
            $role = $this->repository->onlyTrashed()->findorfail($id);
            try {
                DB::beginTransaction();
                if($role){
                    $role->permission()->detach();
                    $role->users()->detach();
                    $role->forceDelete();
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }

        return null;
    }
}
