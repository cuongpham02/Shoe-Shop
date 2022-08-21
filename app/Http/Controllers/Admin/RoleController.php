<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Requests\admin_page\Role\RoleCreateRequest;
use App\Http\Requests\admin_page\Role\RoleUpdateRequest;
use App\Models\Permission;
use App\Repositories\Role\RoleRepository;
use App\Services\Admin\Role\CreateRoleService;
use App\Services\Admin\Role\DeleteRoleService;
use App\Services\Admin\Role\ForceDeleteRoleService;
use App\Services\Admin\Role\RestoreRoleServiece;
use App\Services\Admin\Role\UpdateRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit', config('repository.pagination.limit'));
        $filter = $request->all();

        $result = $this->repository->getAllRoles($limit, $filter);

        return view('admin_page.roles.index', compact('result'));
    }

    /**
     * Show view create Role.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin_page.Role.create',compact('permissions'));
    }

    /**
     * Handel store new role and attack permissions
     * @param CreateRoleRequest $request
     * @param CreateRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request, CreateRoleService $service)
    {
        $attributes = $request->only(['role_name','desc']);
        $permissions = $request->only(['premissions']);
        $service->handle($attributes, $permissions);

        return redirect()->route('admin_page.roles.index');
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

        return view('admin_page.Role.edit',compact('permissions','role_permission', 'role'));
    }

    /**
     * Handle update role and permission
     * @param UpdateRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRoleRequest $request, UpdateRoleService $service)
    {
        $attributes = $request->only(['role_name','desc']);
        $permissions = $request->only(['premissions']);
        $service->handle($id, $attributes, $permissions);

        return redirect()->route('admin_page.roles.index');
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

        return redirect()->route('admin_page.roles.index');
        //        ->with('success', __('messages.request.delete_success'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onlyTrashed()
    {
        $softDeleteRoles = $this->repository->getSoftDeleteRoles();

        return view('admin_page.roles.list_soft_deletes_roles');
    }

    /**
     * Restore Role.
     * @param $id
     * @param RestoreRoleServiece $serviece
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id, RestoreRoleServiece $serviece)
    {
        $serviece->handle($id);

        return redirect()->route('admin_page.roles.index');
        //        ->with('success', __('messages.success.restore_success'));
    }

    /**
     * @param $id
     * @param ForceDeleteRoleService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id, ForceDeleteRoleService $service)
    {
        $service->handle($id);

        return redirect()->route('admin_page.roles.index');
        //        ->with('success', __('messages.success.force_delete_success'));
    }
}
