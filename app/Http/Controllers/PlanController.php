<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
{
    public function __construct(Plan $plan)
    {

        $this->plan = $plan;
    }
    public function index()
    {
        $plans = Plan::all();
        // dd( $plans);
        return view('plans.index', compact('plans'));

    }

    public function show(Plan $plan, Request $request)
    {
        if($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
            return redirect()->route('home')->with('success', 'You have already subscribed the plan');
        }
        return view('plans.show', compact('plan'));
    }
}
