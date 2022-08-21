<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

class RestoreUserServiece
{
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $attributes
     * @param $roles
     * @return void
     */
    public function handle($id)
    {
        if (isset($id)) {
            $user = $this->repository->onlyTrashed()->findorfail($id)->restore();
//            ->makeModel()
        }

        return $user;
    }
}
