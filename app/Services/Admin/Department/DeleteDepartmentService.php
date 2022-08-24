<?php

namespace App\Services\Admin\Department;

use App\Repositories\Department\DepartmentRepository;

class DeleteDepartmentService
{
    private $repository;

    /**
     * @param DepartmentRepository $repository
     */
    public function __construct(DepartmentRepository $repository)
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
