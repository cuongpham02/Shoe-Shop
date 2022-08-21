<?php

namespace App\Services\Admin\Role;

use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;

class RestoreRoleServiece
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
     * Restore soft delete Role.
     * @param $attributes
     * @return mixed
     */
    public function handle($id)
    {
        if (isset($attributes)) {
            $role = $this->repository->onlyTrashed()->findorfail($id)->restore();
//            ->makeModel()
        }

        return $role;
    }
}

