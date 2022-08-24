<?php

namespace App\Services\Admin\Department;

use App\Repositories\Department\DepartmentRepository;

class UpdateDepartmentService
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
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function handle($id, $attributes)
    {
        if (isset($attributes)) {
            $department = $this->repository->update($id, $attributes);
        }

        return $department;
    }
}
