<?php

namespace App\Services;

use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RoleService
{
    protected $globalSearch;

    public function __construct()
    {
        $this->globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });
    }

    public function getAll()
    {
        return QueryBuilder::for(Role::class)
            ->with(['permissions' => fn ($query) => $query->select('id', 'description')])
            ->defaultSort('-created_at')
            ->allowedSorts(['name', 'status'])
            ->allowedFilters(['status'])
            ->paginate(request()->get('perPage', 15))
            ->withQueryString();
    }

    public function create(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->syncPermissions($request->permissions);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->fill($request->all());
        $role->save();
        $role->syncPermissions($request->permissions);
    }

    public function delete(Role $role)
    {
        $role->delete();
    }
}
