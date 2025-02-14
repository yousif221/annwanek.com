<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Inquiry;
use App\NewsLetter;
use App\Order;
use App\Orderitem;
use App\BookNowInquiry;
use App\Claim;

use App\Salary;
use App\CouponCode; 
use App\Application;
use App\FreeInquiry;
use App\User;
use App\Userdistance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Session;
use PDF;
class HomeController extends Controller
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
     
            return view('admin.welcome');
        
    }
    public function showbooknow() {
        $inquiries = BookNowInquiry::orderBy('id','desc')->paginate(15);
    
      
        return view('admin.booknow.index', compact('inquiries'));
    }
    public function displaybooknow($id) {
        $inquiry = BookNowInquiry::findOrFail($id);
        return view('admin.booknow.show', compact('inquiry'));
    }
    public function destroybooknow($id) {
        $booknow = BookNowInquiry::destroy($id);
        Session::flash('success', "booknow  Inquiry Deleted Successfully!");
        return redirect()->route('admin.showbooknow');
    }

    public function showInquiries() {
        $inquiries = Claim::orderBy('id','desc')->paginate(15);

      
        return view('admin.inquiry.index', compact('inquiries'));
    }
    public function displayInquiry($id) {
        $inquiry = Claim::findOrFail($id);
        return view('admin.inquiry.show', compact('inquiry'));
    }
    public function destroy($id) {
        $inquiry = Claim::destroy($id);
        Session::flash('success', "Inquiry Deleted Successfully!");
        return redirect()->route('admin.showInquiries');
    }
    public function showOrders(){
        $orders = Order::orderBy('id','desc')->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
     
    }
    public function displayOrders($id) {
        $order = Order::findOrFail($id);
        $orderitem = Orderitem::where('order_id',$order->id)->get();
        return view('admin.orders.show', compact('order','orderitem'));
    }
    public function Invoice($id)
    {
        $logo = getConfig('logo');
        $favicon = getConfig('favicon');
        $order_detail = Order::where('id',$id)->first();
        $customer_info = User::where('id',$order_detail->user_id)->first();
        $order_details = Orderitem::where('order_id',$order_detail->id)->get();
        $pdf = PDF::loadView('admin.orders.invoice',compact('order_detail','customer_info','order_details','logo','favicon'));
        return $pdf->stream('index.pdf');
    }
    public function destroyOrders($id) {
        $orders = Order::destroy($id);
        Session::flash('success', "Order Deleted Successfully!");
        return redirect()->route('admin.showOrders');
    }

    public function update(Request $request, Order $order)
    {
        $order_status = $request->order_status;
        Order::where('id', $request->order_number)
            ->update([
                'order_status' => $order_status,
            ]);
        Session::flash('success','Order Status Has Been Updated Successfully!');
        return redirect()->route('admin.showOrders');
    }

    
    public function showfreeinquiry() {
       
        $inquiries = FreeInquiry::orderBy('id','desc')->paginate(15);
    
        return view('admin.inquiry_free.index', compact('inquiries'));
    }
    public function displayfreeinquiry($id) {
        $inquiry = FreeInquiry::findOrFail($id);
        return view('admin.inquiry_free.show', compact('inquiry'));
    }
    public function destroyfreeinquiry($id) {
        $inquiries = FreeInquiry::destroy($id);
        Session::flash('success', "Product Inquiry Deleted Successfully!");
        return redirect()->route('admin.showfreeinquiry');
    }









    public function showSubscriptions() {
        $subscriptions = NewsLetter::orderBy('id','desc')->get();
        return view('admin.newsletter.index', compact('subscriptions'));
    }
    public function deleteSubscriptions($id) {
        $subscriptions = NewsLetter::destroy($id);
        Session::flash('success', "Newsletter Deleted Successfully!");
        return redirect()->route('admin.showSubscriptions');
    }
    
    public function markAsNotification(Request $request)
    {
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
        $q =  auth()->user()->Notifications->where('id',$request->input('id'))->first();
        return response()->json(['message' => 'Thank You For  Submiting Salary Form', 'status' => '1','id'=>$q->data['id']]);
        // return response()->noContent();
    }

    public function showsalaries() {
        $salaries = Salary::orderBy('id','desc')->paginate(15);
    
      
        return view('admin.salary.index', compact('salaries'));
    }
    public function displaysalaries($id) {
        $salary = Salary::findOrFail($id);
        return view('admin.salary.show', compact('salary'));
    }
    public function destroysalary($id) {
        $salary = Salary::destroy($id);
        Session::flash('success', "Salary  Inquiry Deleted Successfully!");
        return redirect()->route('admin.showsalaries');
    }


    public function showapplications() {
        $application = Application::orderBy('id','desc')->paginate(15);
    
      
        return view('admin.application.index', compact('application'));
    }
    public function displayapplications($id) {
        $application = Application::findOrFail($id);
        return view('admin.application.show', compact('application'));
    }
    public function destroyapplications($id) {
        $application = Application::destroy($id);
        Session::flash('success', "Applicaition  Inquiry Deleted Successfully!");
        return redirect()->route('admin.showapplications');
    }

    
    public function showcoupon() {
        $coupon = CouponCode::orderBy('id','desc')->paginate(15);
    
      
        return view('admin.coupon.index', compact('coupon'));
    }
    
    public function destroycoupon($id) {
        $coupon = CouponCode::destroy($id);
        Session::flash('success', "Coupon  Inquiry Deleted Successfully!");
        return redirect()->route('admin.showcoupon');
    }
}
