<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // Добавьте это

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Список политики, соответствующий моделям.
     *
     * @var array
     */
    protected $policies = [
        User::class => AdminPolicy::class,
    ];

    /**
     * Зарегистрируйте любые приложения для авторизации.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Используем Gate для проверки роли admin
        Gate::define('admin', [AdminPolicy::class, 'manage']);
    }
}
