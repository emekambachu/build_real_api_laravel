<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Scope;

class BuyerScope implements Scope{
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->has('transactions');
    }
}
