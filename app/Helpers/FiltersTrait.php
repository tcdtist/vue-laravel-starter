<?php

namespace App\Helpers;

use Carbon\Carbon;
use Spatie\QueryBuilder\AllowedFilter;

trait FiltersTrait
{
    public function startCreatedDate()
    {
        return AllowedFilter::callback('start_date', function ($query, $date) {
            $query->whereDate('created_at', '>=', Carbon::parse($date));
        });
    }

    public function endCreatedDate()
    {
        return AllowedFilter::callback('end_date', function ($query, $date) {
            $query->whereDate('created_at', '<=', Carbon::parse($date));
        });
    }
}
