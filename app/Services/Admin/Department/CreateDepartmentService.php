<?php

namespace App\Services\Admin\Department;

use App\Repositories\Department\DepartmentRepository;

class CreateDepartmentService
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
     * Create new Department.
     * @param $attributes
     * @return mixed
     */
    public function handle($attributes)
    {
        if (isset($attributes)) {
            $department = $this->repository->create($attributes);
        }

        return $department;
    }
}

