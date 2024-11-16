<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ToastNotificationTrait;

    protected $roles;

    protected $permissions;

    const NAMEITEM = 'Rol';

    public function __construct(RoleService $roles, PermissionService $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->authorizeResource(Role::class);
    }

    public function index(): Response
    {
        $filters = request()->all();
        $roles = $this->roles->getAll();

        return Inertia::render('Admin/Roles/Index', compact('filters', 'roles'));
    }

    public function create(): Response
    {
        $permissions = $this->permissions->getAll();

        return Inertia::render('Admin/Roles/Create', compact('permissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $this->roles->create($request);

        return to_route('roles.index')->with($this->created(nameItem: self::NAMEITEM));
    }

    public function edit(Role $role): Response
    {
        $permissions = $this->permissions->getAll();
        $role->load(['permissions' => fn ($query) => $query->select('id')])->get();

        return Inertia::render('Admin/Roles/Edit', compact('permissions', 'role'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $this->roles->update($request, $role);

        return to_route('roles.index')->with($this->updated(nameItem: self::NAMEITEM));
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->roles->delete($role);

        return to_route('roles.index')->with($this->deleted(nameItem: self::NAMEITEM));
    }
}
