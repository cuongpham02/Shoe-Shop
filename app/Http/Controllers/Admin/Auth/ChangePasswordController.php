<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\ChangePasswordService;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    /**
     * Show view change password
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin_page.auths.change_password');
    }

    /**
     * Handle change password
     *
     * @param ChangePasswordRequest $request
     * @param ChangePasswordService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request, ChangePasswordService $service)
    {
        $attributes = $request->validated();
        $service->handle($attributes);

        return redirect()->back()->with('message', __('messages.success.changed_password'));
    }
}
