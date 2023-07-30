<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionCheckoutRequest;
use App\Http\Resources\Landlord\LeaseResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscriptionCheckoutURL(SubscriptionCheckoutRequest $request): JsonResponse
    {
        $plansMap = config('subscription')['plans'];
        $selectedPlan = $plansMap[$request->get('plan')];

        $checkout = $request->user()
            ->newSubscription($selectedPlan['name'], $selectedPlan['price'])
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('test'),
                'cancel_url' => route('test'),
            ]);

        /** @var string $checkout */
        $checkout = json_encode($checkout);
        $url = json_decode($checkout, true)['url'];

        return response()->json([
            'success' => true,
            'data' => $url
        ]);
    }
}
