<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 12/11/2018
 * Time: 00:35
 */

namespace App\Service;

use App\Repository\ManageAdministratorsRepository,
    App\Models\User;

class ManageAdministratorsService
{
    /** @var ManageAdministratorsRepository */
    private $repository;

    /**
     * ManageAdministratorsService constructor.
     * @param ManageAdministratorsRepository $repository
     */
    public function __construct(ManageAdministratorsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @param int $role_id
     * @return mixed
     */

    public function setRole(User $user, int $role_id = 0)
    {
        return $this->repository->set($user, $role_id);
    }
}