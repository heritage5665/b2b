<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\Agency;
use Closure;

class ConditionalAuth extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $domain = $request->root();

        $agency = Agency::where('domain', $domain)->first();

        if(!$agency) {
            return abort(404);
        }

        $request->request->add(['agency' => $agency]);

        if(!$agency->is_b_to_c) {
            $this->authenticate($request, $guards);
        }
        
        return $next($request);
    }
    
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('home');
        }
    }
}
