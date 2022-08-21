<?php

namespace App\Services\Admin\Role;

use App\Repositories\Role\RoleRepository;

class DeleteRoleService
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
     * Soft Delete Role.
     * @param $id
     * @return null
     */
    public function handle($id)
    {
        if (isset($id)) {
            $this->repository->delete($id);
        }

        return true;
    }
}
