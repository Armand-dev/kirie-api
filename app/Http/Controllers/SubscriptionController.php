<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionCheckoutRequest;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscriptionCheckoutURL(SubscriptionCheckoutRequest $request)
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
        return json_decode(json_encode($checkout), true)['url'];
    }
}
