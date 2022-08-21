<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Role\RoleRepository;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Role;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $limit
     * @param array|null $filter
     * @return mixed|void
     */
    public function getAllRoles($limit = null, array $filter = null)
    {

        $this->_withFilter($filter);

        if (isset($filter['sortedBy']) && isset($filter['orderBy'])) {
            if ($limit) {
                $result = $this->paginate($limit);
            } else {
                $result = $this->get();
            }
        } else {
            if ($limit) {
                $result = $this->orderBy('created_at', 'DESC')->paginate($limit);
            } else {
                $result = $this->orderBy('created_at', 'DESC')->get();
            }
        }

        return $result;
    }

    /**
     * Get Roles SoftDelete;
     * @return mixed
     */
    public function getSoftDeleteRoles()
    {
        $roles = $this->model->onlyTrashed();

        return $roles;
    }

    /**
     * @param array $filter
     * @return $this
     */
    private function _withFilter(array $filter = [])
    {
        if (isset($filter['keyword'])) {
            $this->model = $this->model->where(function (Builder $query) use ($filter) {
                $query->where('desc', 'LIKE', "%{$filter['keyword']}%")
                    ->orWhere('email', 'LIKE', "%{$filter['keyword']}%")
                    ->orWhere('phone', 'LIKE', "%{$filter['keyword']}%")
                    ->orWhere('name', 'LIKE', "%{$filter['keyword']}%");
            });
        }

        if (isset($filter['sort_by']) && isset($filter['order_by'])) {
            $sort = ['desc', 'asc'];
            if (!in_array($filter['order_by'], $sort)) {
                $filter['order_by'] = 'asc';
            }

            $this->model = $this->model->orderBy($filter['sort_by'], $filter['order_by']);
        }

        return $this;
    }

}
