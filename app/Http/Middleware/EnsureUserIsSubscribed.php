<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSubscribed
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$subscriptions): Response
    {
        if (env('APP_ENV') != 'production') {
            return $next($request);
        }

        $plansMap = config('subscription')['plans'];

        $isSubscribed = false;
        foreach ($subscriptions as $subscription)
        {
            $subscription = $plansMap[$subscription]['name'];
            if ($request->user() && $request->user()->subscribed($subscription)) {
                $isSubscribed = true;
                break;
            }
        }

        $exception = new HttpResponseException(response()->json([
            'success' => false,
            'errors' => [
                'Subscription not valid.'
            ]
        ], 422));

        return $isSubscribed ? $next($request) : throw $exception;
    }
}
