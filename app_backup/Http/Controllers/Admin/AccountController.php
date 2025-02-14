<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Commission;
use App\Invoice;
use Illuminate\Contracts\Support\Renderable;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index() {
        $accounts = User::all()->whereNotIn('role', [1]);
        return view('admin.account.index', compact('accounts'));
    }

    public function account($id) {
        $user = User::findorFail($id);
        $payments = Invoice::all()->where('user_id', $id)->sortByDesc('id');
        if(getAccountType($user->role) == 'Business Developer') {
            $bds = User::where('referrer', $id)->where('role', 2)->get();
            $sellers = User::where('referrer', $id)->where('role', 3)->get();
            $manufacturers = User::where('referrer', $id)->where('role', 4)->get();
            $commissions = Commission::where('user_id', $id)->get('amount');
            $earning = 0;
            if($commissions->count())
                foreach($commissions as $commission) {
                    $earning += $commission->amount;
                }
            return view('admin.account.show', compact(['bds', 'sellers', 'manufacturers', 'user', 'earning', 'payments']));
        }
        return view('admin.account.show', compact(['user', 'payments']));
    }
}
