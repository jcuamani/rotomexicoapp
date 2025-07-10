<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Models\ErpConnection;

class BusinessCentralService
{
    //protected string $tenantId;
    protected string $clientId;
    protected string $clientSecret;
    protected string $scope_url;
    //protected string $environment;
    //protected string $company;

    protected string $AccessTokenURL;
    protected string $WebserviceURL;
    

    public function __construct()
    {        
        $BCConnection = ErpConnection::first();
        $this->AccessTokenURL   =   $BCConnection->access_token_url;
        $this->clientId         =   $BCConnection->clientid;
        $this->clientSecret     =   Crypt::decryptString($BCConnection->client_secret);
        $this->WebserviceURL    =   $BCConnection->webservice_url;
        $this->scope_url        =   $BCConnection->scope_url;
        /*
        $this->tenantId      = config('services.bc.tenant_id');
        $this->clientId      = config('services.bc.client_id');
        $this->clientSecret  = config('services.bc.client_secret');
        $this->scope         = 'https://api.businesscentral.dynamics.com/.default';
        $this->environment   = config('services.bc.environment', 'sandbox');
        $this->company       = config('services.bc.company');
        */
    }

    public function getAccessToken(): string
    {

        //$url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";
        

        $response = Http::asForm()->post($this->AccessTokenURL, [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope'         => $this->scope_url,            
        ]);

        if (!$response->successful()) {
            throw new \Exception('Error obteniendo token: ' . $response->body());
        }

        return $response->json()['access_token'];
    }

    public function probarConexion()
    {
        
        $accessToken = $this->getAccessToken();

        $webResponse = Http::withToken($accessToken)
            ->acceptJson()
            ->get($this->WebserviceURL);

        if (!$webResponse->successful()) {
            //Log::error('Error al consumir el WebService: ' . $webResponse->body());
            return response()->json(['error' => 'No se pudo acceder al WebService'], 500);
        }

        return $webResponse->json();

    }

    public function getCustomers()
    {
        $token = $this->getAccessToken();

        $company = rawurlencode($this->company);
        $odataUrl = "https://api.businesscentral.dynamics.com/v2.0/{$this->tenantId}/{$this->environment}/ODataV4/Company('{$company}')/Customer";

        $response = Http::withToken($token)->get($odataUrl);

        if (!$response->successful()) {
            throw new \Exception('Error obteniendo datos: ' . $response->body());
        }

        return $response->json();
    }
}
