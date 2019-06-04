<?php

namespace App\Services;

use Captcha;

class CodeService extends BaseService
{
    public function captcha()
    {
        return Captcha::src();
    }
}