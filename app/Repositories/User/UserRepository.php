<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\User;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param $limit
     * @param $filter
     * @return mixed
     */
    public function getAllUsers($limit = null, $filter = null);

    /**
     * @return mixed
     */
    public function getSoftDeleteUsers();
}
