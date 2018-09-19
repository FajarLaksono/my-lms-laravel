<?php

namespace App\Http\Middleware;

use Closure;

class UserWebRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeAction = $request->route()->getAction();
        $roles = isset($routeAction['user_web_role'])?$routeAction['user_web_role']:null;
        $user_role = $request->user()->isWebAdmin();
        if(!empty($user_role)){
            if(in_array($user_role, $roles)){
                return $next($request);
            }
        }
        return abort('404');
    }
}
