<?php

namespace App\Policies;

use App\Helpers\PolicyMessageTrait;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use PolicyMessageTrait;

    const NAMEITEM = 'usuarios';

    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('view users')
            ? Response::allow()
            : Response::deny($this->getMessage(action: 'view', nameItem: self::NAMEITEM));
    }

    public function create(User $user): Response
    {
        return $user->hasPermissionTo('create users')
            ? Response::allow()
            : Response::deny($this->getMessage(action: 'create', nameItem: self::NAMEITEM));
    }

    public function update(User $user): Response
    {
        return $user->hasPermissionTo('edit users')
            ? Response::allow()
            : Response::deny($this->getMessage(action: 'edit', nameItem: self::NAMEITEM));
    }

    public function delete(User $user): Response
    {
        return $user->hasPermissionTo('delete users')
            ? Response::allow()
            : Response::deny($this->getMessage(action: 'delete', nameItem: self::NAMEITEM));
    }
}
