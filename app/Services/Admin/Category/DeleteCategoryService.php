<?php

namespace App\Services\Admin\Category;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Department\DepartmentRepository;
use Database\Factories\CategoryFactory;
use function PHPUnit\Framework\isEmpty;

class DeleteCategoryService
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
    public function handle($id)
    {
        $category = $this->repository->find($id);

        if (isEmpty($category->childrenCategory()) || isEmpty($category->product())) {
            $category->delete();
            return redirect()->back()->with('message', __('massages.susscec.delete'));
        } else {
            return redirect()->back()->with('message', __('massages.fail.delete'));
        }
    }
}

