<?php

namespace App\Repositories\Role;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories\Role;
 */
interface RoleRepository extends RepositoryInterface
{
    /**
     * List Roles
     * @param $limit
     * @param array|null $filter
     * @return mixed
     */
    public function getAllRoles($limit = null, array $filter = null);

    /**
     * List Soft Delete Roles
     * @return mixed
     */
    public function getSoftDeleteRoles();
}
