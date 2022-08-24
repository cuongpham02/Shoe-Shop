<?php

namespace App\Services\Admin\Department;

use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;

class ForceDeleteDepartmentService
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
     * Force delete department and Permission related.
     * @param $id
     * @return null
     */
    public function handle($id)
    {
        if (isset($id)) {
            $department = $this->repository->onlyTrashed()->findorfail($id);
            $department->forceDelete();
        }

        return null;
    }
}
