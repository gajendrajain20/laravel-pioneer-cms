<?php

namespace Modules\Admin\Middleware;

use Closure;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    //    if (!($request->user()->is('admin') || $request->user()->is('editor'))) {
    //        return redirect()->route('admin.login.index');
    //    }

        return $next($request);
    }
}
