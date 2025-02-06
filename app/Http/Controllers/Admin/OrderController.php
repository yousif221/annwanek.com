<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Orderitem;
use App\User;
use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use PDF;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $orders = Order::orderBy('id','DESC')->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function create() {
        return view('admin.testimonial.create');
    }

    public function store(Request $request) {
        $team =  new Testimonial();
        $team->name = $request->input('name');
        $team->review = $request->input('review');
        $team->save();
        Session::flash('success','New Testimonial Detail Has Been Added!');
        return redirect()->route('admin.testimonial.index');

    }

    public function show($id)
    {
        $order = Order::findorFail($id);
        $orderitem = Orderitem::where('order_id',$order->id)->get();
        return view('admin.orders.index', compact('order','orderitem'));
    }

    public function update(Request $request, Order $order)
    {
        $order_status = $request->order_status;
        $ariving_time = $request->ariving_time;
        Order::where('id', $request->order_number)
            ->update([
                'order_status' => $order_status,
                'ariving_time' => $ariving_time,
            ]);
        Session::flash('success','Order Status Has Been Updated Successfully!');
        return redirect()->route('admin.showOrders');
    }

    public function destroy($id) {
        $order = Order::findorFail( $id );
        $order->delete();
        Session::flash('success', "Order Has Been deleted Successfully!");
        return redirect()->back();
    }

    public function Invoice($id)
    {
        $logo = getConfig('logo');
        $favicon = getConfig('favicon');
        $order_detail = Order::where('id',$id)->first();
        $customer_info = User::where('id',$order_detail->user_id)->first();
        if ($customer_info == null) {
            $customer_info = $order_detail->user_id;
        }
        $order_details = Orderitem::where('order_id',$order_detail->id)->get();
        $pdf = PDF::loadView('admin.order.invoice',compact('order_detail','customer_info','order_details','logo','favicon'));
        return $pdf->stream('index.pdf');
    }
}