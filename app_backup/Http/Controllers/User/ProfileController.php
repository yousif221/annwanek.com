<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Package;
use App\Product;
use App\Orderitem;
use App\Category;
use App\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ReferralInvite;
use Cartalyst\Stripe\Stripe;
use Session;
use PDF;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.profile.index');
    }
    public function User() {
        return view('admin.userprofile.index');
    }

    public function userDashboard(){
        return view('admin.welcome');
    }

    public function update(User $user, Request $request) {
        $validator = Validator::make($request->all() , [
            'f_name' => ['required', 'string', 'max:25'],
            'l_name' => ['required', 'string', 'max:25'],
            'contact' => ['required'],
            'address_1' => ['required', 'string', 'max:25'],
        //  'username' => ['required', 'string', 'max:100', 'unique:users,username,'.$user->id],
        ], [
            'f_name.max' => 'First Name can not have more than :max characters.',
            'f_name.required' => 'First Name is required.',
            'l_name.max' => 'Last Name can not have more than :max characters.',
            'l_name.required' => 'Last Name is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'Choose the more unique Username.',
            'address_1.max' => 'Address can not have more than :max characters.',
            'address_1.required' => 'Address  is required.',
        ]);
        if ($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withErrors($validator )->withInput();
        }
        $user->first_name = $request->f_name;
        $user->last_name = $request->l_name;
        $user->address_1 = $request->address_1;
        $user->contact = $request->contact;
        $user->username = $request->username;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $image = upload($file, 500, 500, 'profile');
            $user->profile_image = $image;
        }
        if(auth()->user()->hasRole('Administrator')) {
            if (isset($request->password))
            $user->password = Hash::make($request->password);
            $user->is_active = (isset($request->is_active))?1:0;
        }
        $user->save();
        Session::flash('success', 'Profile Information updated successfully');
        return redirect()->back();
        
    }

    public function updatePassword(User $user, Request $request) {
        if (Hash::check($request->current_password, $user->password)) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'different:current_password','confirmed'],
            ], [
                'password.min' => 'Please choose a stronger password with a minimum length of :min characters for your account.',
                'password.confirmed' => 'Your new Passwords does not match.',
                'password.different'=>'New password must be unique'
            ]);
            if ($validator->fails()) {
                Session::flash('error', $validator->errors()->first());
                return redirect()->back();
            }
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('success', 'Password Changed Successfully');
        } else {
            Session::flash('error', 'Incorrect Current Password');
        }
        return redirect()->back();
    }
    
    public function orderPage(){
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('user.order.index',compact('orders'));
    }

    public function orderDetailPage($id){
        $order = Order::findOrFail($id);
        $orderitems = Orderitem::where('order_id',$order->id)->get();
        $customer = User::findOrFail(auth()->user()->id);
        return  view('user.order.show',compact('order','orderitems','customer'));
    }

    public function Invoice($id)
    {
        $logo = getConfig('logo');
        $favicon = getConfig('favicon');
        $order_detail = Order::where('id',$id)->first();
        $customer_info = User::where('id',$order_detail->user_id)->first();
        $order_details = Orderitem::where('order_id',$order_detail->id)->get();
        $pdf = PDF::loadView('user.order.invoice',compact('order_detail','customer_info','order_details','logo','favicon'));
        return $pdf->stream('index.pdf');
    }
}