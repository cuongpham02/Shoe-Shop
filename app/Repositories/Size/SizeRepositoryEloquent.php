<?php

namespace App\Repositories\Size;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Size\SizeRepository;
use App\Entities\Size\Size;
use App\Validators\Size\SizeValidator;

/**
 * Class SizeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Size;
 */
class SizeRepositoryEloquent extends BaseRepository implements SizeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Size::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
