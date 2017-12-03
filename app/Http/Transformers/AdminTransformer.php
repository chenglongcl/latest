<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 2017/12/3
 * Time: 13:27
 */

namespace App\Http\Transformers;

use App\Models\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    protected $authorization;

    public function transform(Admin $admin)
    {
        return $admin->attributesToArray();
    }

    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;

        return $this;
    }

    public function includeAuthorization(Admin $admin)
    {
        if (!$this->authorization) {
            return $this->null();
        }

        return $this->item($this->authorization, new AuthorizationTransformer());
    }
}