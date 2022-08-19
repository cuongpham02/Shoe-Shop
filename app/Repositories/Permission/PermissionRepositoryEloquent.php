<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Permission\PermissionRepository;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Permission;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
