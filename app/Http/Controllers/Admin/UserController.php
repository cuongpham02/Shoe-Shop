<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Role;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\Admin\User\CreateUserService;
use App\Services\Admin\User\DeleteUserService;
use App\Services\Admin\User\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $repository, $roleRepository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit', config('repository.pagination.limit'));
        $filter = $request->all();
        $result = $this->repository->getAllUsers($limit, $filter);

        return view('admin_page.users.index', compact('result'));
    }

    /**
     * Show view create Role.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->roleRepository->all();

        return view('admin_page.users.create',compact('roles'));
    }

    /**
     * Handel store new user and attack role
     * @param CreateUserRequest $request
     * @param CreateUserService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request, CreateUserService $service)
    {
        $attributes = $request->all();
        $roles = $request->only(['roles']);
        $service->handle($attributes, $roles);

        return redirect()->route('admin_page.users.index');
        //        ->with('success', __('messages.request.create_success'));
    }

    /**
     * Show view edit Role.
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user =$this->repository->find($id);
        $roles = $this->roleRepository->all();
        $use_roles = DB::table('user_role')->where('user_id', $id)->pluck('role_id');

        return view('admin_page.users.edit',compact('user','use_roles', 'roles'));
    }

    /**
     * Handle update role and permission
     * @param UpdateUserService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateUserRequest $request, UpdateUserService $service)
    {
        $attributes = $request->all();
        $roles = $request->only(['roles']);
        $service->handle($id, $attributes, $roles);

        return redirect()->route('admin_page.roles.index');
        //        ->with('success', __('messages.request.update_success'));
    }

    /**
     * Handle softDelete role;
     * @param $id
     * @param DeleteUserService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, DeleteUserService $service)
    {
        $service->handle($id);

        return redirect()->route('admin_page.users.index');
        //        ->with('success', __('messages.request.delete_success'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onlyTrashed()
    {
        $softDeleteUsers = $this->repository->getSoftDeleteRoles();

        return view('admin_page.roles.list_soft_deletes_users', compact('softDeleteUsers'));
    }

    /**
     * Restore Role.
     * @param $id
     * @param RestoreUserServiece $serviece
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id, RestoreUserServiece $serviece)
    {
        $serviece->handle($id);

        return redirect()->route('admin_page.users.index');
        //        ->with('success', __('messages.success.restore_success'));
    }

    /**
     * @param $id
     * @param ForceDeleteUserService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id, ForceDeleteUserService $service)
    {
        $service->handle($id);

        return redirect()->route('admin_page.users.index');
        //        ->with('success', __('messages.success.force_delete_success'));
    }
}
