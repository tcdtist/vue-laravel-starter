<?php

namespace App\Services;

use App\Helpers\FiltersTrait;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserService
{
    use FiltersTrait;

    protected $globalSearch;

    public function __construct()
    {
        $this->globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('identification_number', 'LIKE', "%{$value}%")
                        ->orWhere('full_name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
    }

    public function getAll()
    {
        return QueryBuilder::for(User::class)
            ->select('id', 'identification_number', 'full_name', 'email', 'role', 'status')
            ->defaultSort('-created_at')
            ->allowedSorts(['identification_number', 'full_name', 'email', 'role', 'status'])
            ->allowedFilters(['status', 'role', $this->globalSearch, $this->startCreatedDate(), $this->endCreatedDate()])
            ->paginate(request()->get('perPage', 15))
            ->withQueryString();
    }

    public function create(UserRequest $request): void
    {
        $user = User::create($request->all());
        $user->assignRole($request->role);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());

        if (! $request->password) {
            $oldPassword = $user->getOriginal('password');
            $user->fill([
                'password' => $oldPassword,
            ]);
        }

        $user->save();

        $user->roles()->detach();

        $user->assignRole($request->role);
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
