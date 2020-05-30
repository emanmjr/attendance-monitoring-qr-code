<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfTempPassIsChanged
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
        if (auth()->user()->is_password_changed == null) {
            return redirect()->route('temp.password.change')->withFlashSuccess('You need to change your temporary password.');
        }
        return $next($request);
        
    }
}
