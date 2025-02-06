<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Userdistance;
use App\UserPackage;
use Carbon\Carbon;
use App\Distance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::where('role','!=','0')->get();
        return view('admin.user.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('admin.user.edit', compact('user'));
    }
    public function graph($id)
    {
        $from = Carbon::now()->subDays(30);
        $to = Carbon::now();
        $s30 = Carbon::now()->startOfDay()->subDays(30);
        $e30 = Carbon::now()->endOfDay()->subDays(30);
        $s29 = Carbon::now()->startOfDay()->subDays(29);
        $e29 = Carbon::now()->endOfDay()->subDays(29);
        $s28 = Carbon::now()->startOfDay()->subDays(28);
        $e28 = Carbon::now()->endOfDay()->subDays(28);
        $s27 = Carbon::now()->startOfDay()->subDays(27);
        $e27 = Carbon::now()->endOfDay()->subDays(27);
        $s26 = Carbon::now()->startOfDay()->subDays(26);
        $e26 = Carbon::now()->endOfDay()->subDays(26);
        $s25 = Carbon::now()->startOfDay()->subDays(25);
        $e25 = Carbon::now()->endOfDay()->subDays(25);
        $s24 = Carbon::now()->startOfDay()->subDays(24);
        $e24 = Carbon::now()->endOfDay()->subDays(24);
        $s23 = Carbon::now()->startOfDay()->subDays(23);
        $e23 = Carbon::now()->endOfDay()->subDays(23);
        $s22 = Carbon::now()->startOfDay()->subDays(22);
        $e22 = Carbon::now()->endOfDay()->subDays(22);
        $s21 = Carbon::now()->startOfDay()->subDays(21);
        $e21 = Carbon::now()->endOfDay()->subDays(21);
        $s20 = Carbon::now()->startOfDay()->subDays(20);
        $e20 = Carbon::now()->endOfDay()->subDays(20);
        $s19 = Carbon::now()->startOfDay()->subDays(19);
        $e19 = Carbon::now()->endOfDay()->subDays(19);
        $s18 = Carbon::now()->startOfDay()->subDays(18);
        $e18 = Carbon::now()->endOfDay()->subDays(18);
        $s17 = Carbon::now()->startOfDay()->subDays(17);
        $e17 = Carbon::now()->endOfDay()->subDays(17);
        $s16 = Carbon::now()->startOfDay()->subDays(16);
        $e16 = Carbon::now()->endOfDay()->subDays(16);
        $s15 = Carbon::now()->startOfDay()->subDays(15);
        $e15 = Carbon::now()->endOfDay()->subDays(15);
        $s14 = Carbon::now()->startOfDay()->subDays(14);
        $e14 = Carbon::now()->endOfDay()->subDays(14);
        $s13 = Carbon::now()->startOfDay()->subDays(13);
        $e13 = Carbon::now()->endOfDay()->subDays(13);
        $s12 = Carbon::now()->startOfDay()->subDays(12);
        $e12 = Carbon::now()->endOfDay()->subDays(12);
        $s11 = Carbon::now()->startOfDay()->subDays(11);
        $e11 = Carbon::now()->endOfDay()->subDays(11);
        $s10 = Carbon::now()->startOfDay()->subDays(10);
        $e10 = Carbon::now()->endOfDay()->subDays(10);
        $s9 = Carbon::now()->startOfDay()->subDays(9);
        $e9 = Carbon::now()->endOfDay()->subDays(9);
        $s8 = Carbon::now()->startOfDay()->subDays(8);
        $e8 = Carbon::now()->endOfDay()->subDays(8);
        $sevens = Carbon::now()->startOfDay()->subDays(7);
        $sevene = Carbon::now()->endOfDay()->subDays(7);
        $sixs = Carbon::now()->startOfDay()->subDays(6);
        $sixe = Carbon::now()->endOfDay()->subDays(6);
        $fives = Carbon::now()->startOfDay()->subDays(5);
        $fivee = Carbon::now()->endOfDay()->subDays(5);
        $fours = Carbon::now()->startOfDay()->subDays(4);
        $foure = Carbon::now()->endOfDay()->subDays(4);
        $threes = Carbon::now()->startOfDay()->subDays(3);
        $threee = Carbon::now()->endOfDay()->subDays(3);
        $twos = Carbon::now()->startOfDay()->subDays(2);
        $twoe = Carbon::now()->endOfDay()->subDays(2);
        $ones = Carbon::now()->startOfDay()->subDays(1);
        $onee = Carbon::now()->endOfDay()->subDays(1);
        $currents =Carbon::now()->startOfDay();
        $currente =Carbon::now()->endOfDay();
         $dist30 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s30,$e30])->get();
         $dist29 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s29,$e29])->get();
         $dist28 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s28,$e28])->get();
         $dist27 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s27,$e27])->get();
         $dist26 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s26,$e26])->get();
         $dist25 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s25,$e25])->get();
         $dist24 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s24,$e24])->get();
         $dist23 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s23,$e23])->get();
         $dist22 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s22,$e22])->get();
         $dist21 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s21,$e21])->get();
         $dist20 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s20,$e20])->get();
         $dist19 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s19,$e19])->get();
         $dist18 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s18,$e18])->get();
         $dist17 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s17,$e17])->get();
         $dist16 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s16,$e16])->get();
         $dist15 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s15,$e15])->get();
         $dist14 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s14,$e14])->get();
         $dist13 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s13,$e13])->get();
         $dist12 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s12,$e12])->get();
         $dist11 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s11,$e11])->get();
         $dist10 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s10,$e10])->get();
         $dist9 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s9,$e9])->get();
         $dist8 =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$s8,$e8])->get();
         $sevendist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$sevens,$sevene])->get();
         $sixdist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$sixs,$sixe])->get();
         $fivedist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$fives,$fivee])->get();
         $fourdist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$fours,$foure])->get();
         $threedist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$threes,$threee])->get();
         $twodist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$twos,$twoe])->get();
         $onedist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$ones,$onee])->get();
         $currentdist =  Userdistance::where('user_id',$id)->where('status',0)->whereBetween('end',[$currents,$currente])->get();

         $day30distance = 0;
         $day29distance = 0;
         $day28distance = 0;
         $day27distance = 0;
         $day26distance = 0;
         $day25distance = 0;
         $day24distance = 0;
         $day23distance = 0;
         $day22distance = 0;
         $day21distance = 0;
         $day20distance = 0;
         $day19distance = 0;
         $day18distance = 0;
         $day17distance = 0;
         $day16distance = 0;
         $day15distance = 0;
         $day14distance = 0;
         $day13distance = 0;
         $day12distance = 0;
         $day11distance = 0;
         $day10distance = 0;
         $day9distance = 0 ;
         $day8distance = 0;
         $daysevendistance = 0;
         $daysixdistance = 0;
         $dayfivedistance = 0;
         $dayfourdistance = 0;
         $daythreedistance = 0;
         $daytwodistance = 0;
         $dayonedistance = 0;
         $daycurrentdistance = 0;
         
                foreach($dist30  as $key => $item30){
                    $day30distance += $item30->last_distance;
                }
                foreach($dist29  as $key => $item29){
                    $day29distance += $item29->last_distance;
                }
                foreach($dist28  as $key => $item28){
                    $day28distance += $item28->last_distance;
                }
                foreach($dist27  as $key => $item27){
                    $day27distance += $item27->last_distance;
                }
                foreach($dist26  as $key => $item26){
                    $day26distance += $item26->last_distance;
                }
                foreach($dist25  as $key => $item25){
                    $day25distance += $item25->last_distance;
                }
                foreach($dist24  as $key => $item24){
                    $day24distance += $item24->last_distance;
                }
                foreach($dist23  as $key => $item23){
                    $day23distance += $item23->last_distance;
                }
                foreach($dist22  as $key => $item22){
                    $day22distance += $item22->last_distance;
                }
                foreach($dist21  as $key => $item21){
                    $day21distance += $item21->last_distance;
                }
                foreach($dist20  as $key => $item20){
                    $day20distance += $item20->last_distance;
                }
                foreach($dist19  as $key => $item19){
                    $day19distance += $item19->last_distance;
                }
                foreach($dist18  as $key => $item18){
                    $day18distance += $item18->last_distance;
                }
                foreach($dist17  as $key => $item17){
                    $day17distance += $item17->last_distance;
                }
                foreach($dist16  as $key => $item16){
                    $day16distance += $item16->last_distance;
                }
                foreach($dist15  as $key => $item15){
                    $day15distance += $item15->last_distance;
                }
                foreach($dist14  as $key => $item14){
                    $day14distance += $item14->last_distance;
                }
                foreach($dist13  as $key => $item13){
                    $day13distance += $item13->last_distance;
                }
                foreach($dist12  as $key => $item12){
                    $day12distance += $item12->last_distance;
                }
                foreach($dist11  as $key => $item11){
                    $day11distance += $item11->last_distance;
                }
                foreach($dist10  as $key => $item10){
                    $day10distance += $item10->last_distance;
                }
                foreach($dist9  as $key => $item9){
                    $day9distance += $item9->last_distance;
                }
                foreach($dist8  as $key => $item8){
                    $day8distance += $item8->last_distance;
                }
                foreach($sevendist  as $key => $item7){
                    $daysevendistance += $item7->last_distance;
                }
                foreach($sixdist  as $key => $item6){
                    $daysixdistance += $item6->last_distance;
                }
                foreach($fivedist  as $key => $item5){
                    $dayfivedistance += $item5->last_distance;
                }
                foreach($fourdist  as $key => $item4){
                    $dayfourdistance += $item4->last_distance;
                }
                foreach($threedist  as $key => $item3){
                    $daythreedistance += $item3->last_distance;
                }
                foreach($twodist  as $key => $item2){
                    $daytwodistance += $item2->last_distance;
                }
                foreach($onedist  as $key => $item1){
                    $dayonedistance += $item1->last_distance;
                }
                foreach($currentdist  as $key => $item){
                    $daycurrentdistance += $item->last_distance;
                }
                $d30 = $s30->format('d-m-Y');
                $d29 = $s29->format('d-m-Y');
                $d28 = $s28->format('d-m-Y');
                $d27 = $s27->format('d-m-Y');
                $d26 = $s26->format('d-m-Y');
                $d25 = $s25->format('d-m-Y');
                $d24 = $s24->format('d-m-Y');
                $d23 = $s23->format('d-m-Y');
                $d22 = $s22->format('d-m-Y');
                $d21 = $s21->format('d-m-Y');
                $d20 = $s20->format('d-m-Y');
                $d19 = $s19->format('d-m-Y');
                $d18 = $s18->format('d-m-Y');
                $d17 = $s17->format('d-m-Y');
                $d16 = $s16->format('d-m-Y');
                $d15 = $s15->format('d-m-Y');
                $d14 = $s14->format('d-m-Y');
                $d13 = $s13->format('d-m-Y');
                $d12 = $s12->format('d-m-Y');
                $d11 = $s11->format('d-m-Y');
                $d10 = $s10->format('d-m-Y');
                $d9 = $s9->format('d-m-Y');
                $d8 = $s8->format('d-m-Y');
                $seven = $sevens->format('d-m-Y');
                $six = $sixs->format('d-m-Y');
                $five = $fives->format('d-m-Y');
                $four = $fours->format('d-m-Y');
                $three = $threes->format('d-m-Y');
                $two = $twos->format('d-m-Y');
                $one = $ones->format('d-m-Y');
                $current = $currents->format('d-m-Y');

        $distancs = Userdistance::where('user_id',$id)->where('status','0')->get();
        $user = User::findorFail($id);
        return view('admin.user.graph',compact('distancs','d30','d29','d28','d27','d26','d25','d24','d23','d22','d21','d20','d19','d18','d17','d16','d15',
        'd14','d13','d12','d11','d10','d9','d8','seven','six','five','four','three','two','one','current',
        'day30distance','day29distance','day28distance','day27distance','day26distance','day25distance','day24distance','day23distance','day22distance',
        'day21distance','day20distance','day19distance','day18distance','day17distance','day16distance','day15distance','day14distance','day13distance',
        'day12distance','day11distance','day10distance','day9distance','day8distance','daysevendistance','daysixdistance','dayfivedistance','dayfourdistance',
        'daythreedistance','daytwodistance','dayonedistance','daycurrentdistance','user'
    ));
        
        }
    
    public function distance($id)
    {
        $distancs = Userdistance::where('user_id',$id)->where('status','0')->get();
        $user = User::findorFail($id);
        return view('admin.user.distance', compact('user','distancs'));
    }
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'first_name' => 'regex:/^[a-zA-Z]+$/u|max:255',
            'last_name' => 'regex:/^[a-zA-Z]+$/u|max:255',
            'contact' => 'numeric',
            'address_1' => 'string',
            'address_2' => 'string',
            'city' => 'string',
            'state' => 'string',
            'country' => 'string',
        ], [
            'first_name.regex' => 'First Name does not contain numbers.',
            'last_name.regex' => 'Last Name does not contain numbers.',
            'contact.numeric' => 'Contact field should be in proper format.',
        ]);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->contact = $request->input('contact');
        $user->address_1 = $request->input('address_1');
        $user->address_2 = $request->input('address_2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->save();
        Session::flash('success', "User Details Has Been Updated Successfully!");
        return redirect()->route('admin.user.index');
    }
    public function destroy($id) {
        $faq = User::findorFail( $id );
        $faq->delete();
        Session::flash('success', "User Details deleted Successfully!");
        return redirect()->back();
    }
    public function feature($id) {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();
    
        if ($user->is_active) {
            // If the user is approved
            Session::flash('success', 'User account has been approved successfully!');
         
        } else {
            // If the user is disapproved
            Session::flash('success', 'User account has been Blocked!');
        }
    
        return response()->json(['is_active' => $user->is_active]);
    }
}

