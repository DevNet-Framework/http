<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Middleware;

use DevNet\Http\Message\HttpContext;

interface IMiddleware
{
    public function __invoke(HttpContext $context, RequestDelegate $next);
}
