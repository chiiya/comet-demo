<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

trait AddsEagerLoads
{
    /**
     * Add eager loads to a database query.
     *
     * @param Builder $builder
     * @param array $includes
     * @param array $relations
     *
     * @return Builder
     */
    protected function addEagerLoads(Builder $builder, array $includes, array $relations): Builder
    {
        foreach ($includes as $relationship) {
            if (\in_array($relationship, $relations, true)) {
                $builder = $builder->with($relationship);
            }
        }

        return $builder;
    }
}
