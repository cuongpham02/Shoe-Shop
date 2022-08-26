<?php

namespace App\Services\Admin\Category;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Department\DepartmentRepository;
use Database\Factories\CategoryFactory;

class CreateCategoryService
{
    private $repository;

    /**
     * @param CategoryFactory $repository
     */
    public function __construct(CategoryRepository $repository)
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
            $category = $this->repository->create($attributes);
        }

        return $category;
    }
}

