<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encrypt_param')) {
    function encrypt_param($value)
    {
        return urlencode(Crypt::encrypt($value));
    }
}

if (!function_exists('decrypt_param')) {
    function decrypt_param($value)
    {
        return Crypt::decrypt(urldecode($value));
    }
}

if (!function_exists('secure_route')) {
    function secure_route(string $routeName, array $params = [], string $method = 'GET', string $tiporequest = 'request',string $rutaError='',  int $minutes = 15) 
    {
        $payload = [
            'route' => $routeName,
            'params' => $params,
            'method' => strtoupper($method),
            'expires_at' => now()->addMinutes($minutes)->timestamp,
            'tiporequest' => $tiporequest,
            'rutaError' => $rutaError
        ];

        return route('secure.route', ['data' => urlencode(Crypt::encrypt($payload))]);
    }
}
