<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Repositories\Category\CategoryRepository;
use App\Services\Admin\Category\CreateCategoryService;
use App\Services\Admin\Category\DeleteCategoryService;
use App\Services\Admin\Category\UpdateCategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

    /**
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit', config('repository.pagination.limit'));
        $filter = $request->all();

        $result = $this->repository->getAllCategories($limit, $filter);

        return view('admin_page.categories.index', compact('result'));
    }

    /**
     * Show view create Role.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin_page.categories.create');
    }

    /**
     * Handel store new category
     * @param CreateCategoryRequest $request
     * @param CreateCategoryService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request, CreateCategoryService $service)
    {
        $service->handle($request->all());

        return redirect()->route('admin_page.categories.index');
        //        ->with('success', __('messages.request.create_success'));
    }

    /**
     * Show view edit category.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('admin_page.categories.edit',compact( 'category'));
    }

    /**
     * @param $id
     * @param UpdateCategoryRequest $request
     * @param UpdateCategoryService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateCategoryRequest $request, UpdateCategoryService $service)
    {
        $service->handle($id, $request->all());

        return redirect()->route('admin_page.categories.index');
        //        ->with('success', __('messages.request.update_success'));
    }

    /**
     * Handle softDelete role;
     * @param $id
     * @param DeleteCategoryService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, DeleteCategoryService $service)
    {
        $result = $service->handle($id);

        return $result;
    }
}
