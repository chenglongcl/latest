<?php

namespace App\Http\Controllers\Api;

use App\Services\CodeService;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    protected $codeService;

    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function captcha()
    {
        $captcha = $this->codeService->captcha();
        $result = [
            'url' => $captcha
        ];
        return $this->response->array($result)->setStatusCode(201);
    }
}
