<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 12/11/2018
 * Time: 00:20
 */

namespace App\Repository;


use App\Models\User;

class ManageAdministratorsRepository
{
    /**
     * @param string $login
     * @return mixed
     */

    public function findByLogin(string $login)
    {
        return User::where('login', $login)->first();
    }

    /**
     * @return mixed
     */

    public function all()
    {
        return User::select('login')->get();
    }

    /**
     * @param User $user
     * @param int $make_admin
     * @return void
     */

    public function set(User $user, int $make_admin = 1): void
    {
        $user->update(['is_admin' => $make_admin]);
        $user->save();
    }
}