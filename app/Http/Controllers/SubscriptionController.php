<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Contest;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contest $contest)
    {
        $subscriptions = Subscription::where('contest_id',$contest->id)
                                       ->with('people:id,nome')->paginate();
        return view('subscriptions.index', [
            'contest'       => $contest,
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {
        $subscription = Subscription::where('people_id',$request->people_id)
            ->where('contest_id',$request->contest_id)->get();
        if($subscription->isNotEmpty()){
            request()->session()->flash('alert-danger','Pessoa já inscrita.');
        }
        else {
            Subscription::create($request->validated());
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index',
                                ['contest' => $subscription->contest_id]);
    }
}
