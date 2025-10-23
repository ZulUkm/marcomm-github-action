<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiAuthService
{
    protected $apiUrl;
    
    public function __construct()
    {
        $this->apiUrl = config('services.auth_api.url');
    }
    
    public function authenticate($ukmper, $password)
    {
        try {
           
            $response = Http::post($this->apiUrl . '/shape-api/api/ukm_user/sso_ukm1', [
                'ukmper' => $ukmper,
                'password' => $password,
            ]);

            if ($response->successful()) {
                return $response->json();
            }
            
           
            return null;
        } catch (\Exception $e) {

            echo $e->getMessage();die;
            \Log::error('API Authentication error: ' . $e->getMessage());
            return null;
        }
    }
}