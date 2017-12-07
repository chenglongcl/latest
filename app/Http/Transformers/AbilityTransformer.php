<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Silber\Bouncer\Database\Ability;

class AbilityTransformer extends TransformerAbstract
{
    public function transform(Ability $ability)
    {
        return $ability->attributesToArray();
    }
}