<?php

namespace App\Repositories\Department;

use Illuminate\Database\Query\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Department\DepartmentRepository;
use App\Entities\Department\Department;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Department;
 */
class DepartmentRepositoryEloquent extends BaseRepository implements DepartmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Department::class;
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
    public function getAllDepartments($limit = null, array $filter = null)
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
    public function getSoftDeleteDepartments()
    {
        $result = $this->model->onlyTrashed();

        return $result;
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
