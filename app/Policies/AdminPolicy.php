<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * 
     *
     * @param  \App\Models\User  
     * @return bool
     */
    public function manage(User $user)
    {
        return $user->role === 'admin'; 
    }
}
