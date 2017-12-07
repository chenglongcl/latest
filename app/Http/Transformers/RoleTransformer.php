<?php

namespace App\Http\Transformers;


use League\Fractal\TransformerAbstract;
use Silber\Bouncer\Database\Role;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return $role->attributesToArray();
    }
}