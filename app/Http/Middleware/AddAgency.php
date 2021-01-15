<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Support\Facades\Session;

class AddAgency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->root();

        $agency = new Agency;
        $agency = $agency->getCurrentAgency();

        if(!$agency || !$agency->id) {

            $agency = Agency::where('domain', $domain)->first();
            if($agency) {
                $agency->websiteSettings;
                $keyedSettings = [];
        
                if($agency->websiteSettings) {
                    foreach($agency->websiteSettings as $setting) {
                        $keyedSettings[$setting->name] = $setting;
                    }
                }
                $agency->keyedWebsiteSettings = $keyedSettings;        
            }
        }

        if(!$agency) {
            return abort(404);
        }
        $agency->saveInSession();
        
        $request->request->add(['agency' => $agency]);

        return $next($request);
    }
}
