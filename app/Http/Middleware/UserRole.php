<?php

namespace App\Http\Middleware;

use Closure;

class UserRole
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
        $roles = isset($routeAction['user_role'])?$routeAction['user_role']:null;
        if(is_numeric($request->route()->parameters()['course'])){
          $user_role = $request->user()->getCourseRole( $request->route()->parameters()['course'] );
        }else{
          $user_role = $request->user()->getCourseRoleBySlug( $request->route()->parameters()['course'] );
        }
        if(!empty($user_role)){
            if(in_array($user_role, $roles)){
                return $next($request);
            }
        }
        return redirect()->route('course.show', $request->route()->parameters()['course']);
    }
}
