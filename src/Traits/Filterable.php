<?php
namespace FugaziCode\Filter\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait Filterable {

    /**
     * Eloquent mandatory trait for models that should use a filter.
     *
     * @param Builder $query
     * @param mixed $filter
     * @return Builder
     */
    public function scopeFilter($query, $filter): Builder
    {
        return $filter->apply($query);
    }
}