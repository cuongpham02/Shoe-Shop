<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Role\RoleRepositoryEloquent;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\User\UserRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
     * @param $filter
     * @return mixed|void
     */
    public function getAllUsers($limit = null, $filter = null)
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
     * @return mixed|void
     */
    public function getSoftDeleteUsers()
    {
        $users = $this->model->onlyTrashed();

        return $users;
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
                    ->orWhere('role_name', 'LIKE', "%{$filter['keyword']}%");
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
