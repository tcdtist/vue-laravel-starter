<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionService
{
    protected $globalSearch;

    public function __construct()
    {
        $this->globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%")
                        ->orWhere('module', 'LIKE', "%{$value}%");
                });
            });
        });
    }

    public function getAll()
    {
        return QueryBuilder::for(Permission::class)
            ->select('id', 'description', 'module')
            ->defaultSort('module')
            ->allowedSorts(['description', 'module'])
            ->allowedFilters(['module', $this->globalSearch])
            ->paginate(request()->get('perPage', 15))
            ->withQueryString();
    }
}
