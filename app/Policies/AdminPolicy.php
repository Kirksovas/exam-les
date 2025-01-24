<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Определите, может ли данный пользователь управлять административными маршрутами.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function manage(User $user)
    {
        // Пример, если у вас есть поле role, где роль admin
        return $user->role === 'admin'; 
    }
}
