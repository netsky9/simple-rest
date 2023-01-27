<?php

namespace app\middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Vendor implements IMiddleware
{
    public function handle(Request $request): void
    {
        //todo тут логика проверки прав доступа для продавца
    }
}
