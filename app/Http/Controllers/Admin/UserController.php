<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ToastNotificationTrait;

    protected $users;

    const NAMEITEM = 'Usuario';

    public function __construct(UserService $users)
    {
        $this->users = $users;
        $this->authorizeResource(User::class);
    }

    public function index(): Response
    {
        $filters = request()->all();
        $roles = Role::all()->pluck('name', 'id');
        $users = $this->users->getAll();

        return Inertia::render('Admin/Users/Index', compact('users', 'filters', 'roles'));
    }

    public function create(): Response
    {
        $roles = Role::where('status', 1)->get()->pluck('name', 'id');

        return Inertia::render('Admin/Users/Create', compact('roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->users->create($request);

        return to_route('users.index')->with($this->created(nameItem: self::NAMEITEM));
    }

    public function edit(User $user): Response
    {
        $roles = Role::where('status', 1)->get()->pluck('name', 'id');

        return Inertia::render('Admin/Users/Edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->users->update($request, $user);

        return to_route('users.index')->with($this->updated(nameItem: self::NAMEITEM));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->users->delete($user);

        return to_route('users.index')->with($this->deleted(nameItem: self::NAMEITEM));
    }
}
