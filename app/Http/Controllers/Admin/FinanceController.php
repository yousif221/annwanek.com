<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Commission;
use App\Subscription;

class FinanceController extends Controller
{
    public function payments() {
        $payments = Invoice::all()->sortByDesc('created_at');
        return view('admin.payments.index', compact('payments'));
    }
    
    public function commissions() {
        $commissions = Commission::all()->sortByDesc('created_at');
        return view('admin.commissions.index', compact('commissions'));
    }
    
    public function subscriptions() {
        $subscriptions = Subscription::all()->sortByDesc('created_at');
        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
