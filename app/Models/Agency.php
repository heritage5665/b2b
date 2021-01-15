<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Agency extends Model
{
    use HasFactory;
    protected $table = 'agencies';
    protected $fillable = [
        'name',
        'email',
        'agency_access_code'
    ];

    public function saveInSession() {
        Session::put('agency', $this);
    }
    
    public static function getCurrentAgency() {
        return Session::get('agency');
    }

    public function websiteSetting($setting) {
        return $this->hasOne('App\Models\WebsiteSetting')->where('name', $setting)->first();
    }
    public function websiteSettings() {
        return $this->hasMany('App\Models\WebsiteSetting');
    }

    public function getWebsiteSetting($setting) {
        if($this->keyedWebsiteSettings && array_key_exists($setting, $this->keyedWebsiteSettings)) {
            return $this->keyedWebsiteSettings[$setting];
        }
        return null;
    }
}
