<?php

namespace App\Http\Middleware;

use App\Models\ApiLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    public function handle($request, Closure $next): Response
    {
        $response = $next($request);

        ApiLog::create([
            "user_id" => Auth::id(),
            "endpoint" => $request->fullUrl(),
            "request_body" => $request->getContent(),
            "status_code" => $response->getStatusCode(),
            "response_body" => $response->getContent(),
            "ip"=>$request->ip()
        ]);
        
        return $response;
    }
}
