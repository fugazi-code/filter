<?php

namespace FugaziCode\Filter;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public $query;

    /**
     * If values was assigned here it will call basic where()
     *
     * @var array
     */
    public $filter = [];

    /**
     * Apply the filters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->query = $builder;
        foreach (request()->all() as $callable => $value) {
            if (empty($value)) {
                continue;
            }
            if (method_exists($this, $callable)) {
                $this->$callable($value);
            }
        }

        foreach ($this->filter as $value) {
            $this->query->where($value, request($value));
        }

        return $this->query;
    }

    public function setFilter($filter)
    {
        return $this;
    }
}
