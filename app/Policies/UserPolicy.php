<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $auth, $ability)
    {
        // da acceso libre al administrador
        if ($auth->isAdmin())
        {
            return true;
        } 
    }

    public function edit(User $auth, User $user)
    {
        return $auth->id == $user->id;
    }

    public function update(User $auth, User $user)
    {
        return $auth->id == $user->id;
    }
}
