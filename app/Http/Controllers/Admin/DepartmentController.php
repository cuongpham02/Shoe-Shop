<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Repositories\Department\DepartmentRepository;
use App\Services\Admin\Department\CreateDepartmentService;
use App\Services\Admin\Department\ForceDeleteDepartmentService;
use App\Services\Admin\Department\RestoreDepartmentService;
use App\Services\Admin\Role\CreateRoleService;
use App\Services\Admin\Role\DeleteRoleService;
use App\Services\Admin\Role\ForceDeleteRoleService;
use App\Services\Admin\Role\RestoreRoleServiece;
use App\Services\Admin\Role\UpdateRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit', config('repository.pagination.limit'));
        $filter = $request->all();

        $result = $this->repository->getAllDepartments($limit, $filter);

        return view('admin_page.departments.index', compact('result'));
    }

    /**
     * Show view create Role.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin_page.departments.create');
    }

    /**
     * Handel store new role and attack permissions
     * @param CreateRoleRequest $request
     * @param CreateRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateDepartmentRequest $request, CreateDepartmentService $service)
    {
        $service->handle($request->all());

        return redirect()->route('admin_page.departments.index');
        //        ->with('success', __('messages.request.create_success'));
    }

    /**
     * Show view edit Role.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        $permissions = Permission::all();
        $role_permission = DB::table('role_permission')->where('role_id', $id)->pluck('permission_id');

        return view('admin_page.departments.edit',compact('permissions','role_permission', 'role'));
    }

    /**
     * Handle update role and permission
     * @param UpdateRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRoleRequest $request, UpdateRoleService $service)
    {
        $service->handle($request->all());

        return redirect()->route('admin_page.departments.index');
        //        ->with('success', __('messages.request.update_success'));
    }

    /**
     * Handle softDelete role;
     * @param $id
     * @param DeleteRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, DeleteRoleService $service)
    {
        $service->handle($id);

        return redirect()->route('admin_page.departments.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onlyTrashed()
    {
        $listSoftDelete = $this->repository->getSoftDeleteDepartments();

        return view('admin_page.departments.list_soft_deletes', compact('listSoftDelete'));
    }

    /**
     * Restore.
     * @param $id
     * @param RestoreDepartmentService $serviece
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id, RestoreDepartmentService $serviece)
    {
        $serviece->handle($id);

        return redirect()->route('admin_page.departments.index');
        //        ->with('success', __('messages.success.restore_success'));
    }

    /**
     * @param $id
     * @param ForceDeleteDepartmentService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id, ForceDeleteDepartmentService $service)
    {
        $service->handle($id);

        return redirect()->route('admin_page.departments.index');
        //        ->with('success', __('messages.success.force_delete_success'));
    }
}
