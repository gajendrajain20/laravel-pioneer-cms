<?php

namespace Modules\Admin\Middleware;

Use Closure;
use Illuminate\Auth\Guard;

Class AuthenticateUser
{
    
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    
    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {die('authenticateUser');
        $this->auth = $auth;
    }
    
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
//                 return redirect()->route('admin.login.index');
            }
        }
        
        return $next($request);
    }
}