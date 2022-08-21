<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

class ForceDeleteUserService
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
     * @param $id
     * @return null
     */
    public function handle($id)
    {
        if (isset($id)) {
            $user = $this->repository->onlyTrashed()->findorfail($id);
            try {
                DB::beginTransaction();
                if($user){
                    $user->roles()->detach();
                    $user->forceDelete();
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }

        return null;
    }
}
