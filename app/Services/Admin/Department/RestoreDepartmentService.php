<?php

namespace App\Services\Admin\Department;

use App\Repositories\Department\DepartmentRepository;

class RestoreDepartmentService
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
     * Restore soft delete Role.
     * @param $attributes
     * @return mixed
     */
    public function handle($id)
    {
        if (isset($attributes)) {
            $department = $this->repository->onlyTrashed()->findorfail($id)->restore();
        }

        return $department;
    }
}

