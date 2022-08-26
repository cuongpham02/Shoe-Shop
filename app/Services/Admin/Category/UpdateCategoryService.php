<?php

namespace App\Services\Admin\Category;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Department\DepartmentRepository;
use Database\Factories\CategoryFactory;
use function PHPUnit\Framework\isEmpty;

class UpdateCategoryService
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
    public function handle($id, $attributes)
    {
        if (isset($attributes)) {
            $category = $this->repository->update($id, $attributes);
        }

        return $category;
    }
}

