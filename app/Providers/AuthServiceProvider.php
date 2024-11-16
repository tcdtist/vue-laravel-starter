<?php

namespace App\Providers;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Policies\PaymentMethodPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
