<?php

namespace App\Services;

use Captcha;

class CodeService
{
    public function captcha()
    {
        return Captcha::src();
    }
}