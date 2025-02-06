<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Cart;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::Panel;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('panel');
    }

//     protected function mergeGuestCartWithUserCart($user)
//     {
//         $guestCartSessionId = Session::get('cart_session_id');
//         if (!$guestCartSessionId) {
//             // If no guest cart session ID is found, just proceed with the user cart
//             return;
//         }
//         $guestCart = \Cart::session($guestCartSessionId)->getContent();
     
// // Merge guest cart to the authenticated user cart
// foreach ($guestCart as $item) {
//     $attributes = $item->attributes->attributes; // This will give you an array of the attributes

//     $cartAttributes = [
//         'image' => $item->attributes->image, // Include the product's image
//         'category_id' => $item->attributes->category_id,
//         'sku' => $item->attributes->sku,
//         'attributes' => $attributes, // Store selected attributes
//     ];

//     \Cart::session($user->id)->add([
//         'id' => $item->id,
//         'name' => $item->name,
//         'price' => $item->price,
//         'quantity' => $item->quantity,
//         'attributes' => $cartAttributes,
//         'associatedModel' => $item->associatedModel,
//     ]);
// }

// // Clear the guest cart session
// \Cart::session($guestCartSessionId)->clear();

// // Optionally, remove the guest cart session ID from the session
// Session::forget('cart_session_id');

//     }
    
//     public function authenticated(Request $request, $user)
//     {
//         // Redirect to the intended path after merging carts
//         $this->mergeGuestCartWithUserCart($user);
//         return redirect()->intended($this->redirectPath());
//     }
protected function authenticated(Request $request, $user)
{
    // Check if the user is active
    if (!$user->is_active) {
        Auth::logout(); // Log out inactive user
        Session::flash('error', "Your account is currently blocked. Please contact support or the administrator for assistance."); // Flash error message
        return redirect()->route('login'); // Redirect to the login page
    } else {
        Session::flash('success', "Login successful!"); // Flash success message
        return redirect()->route('login')->with('message', "Login successful!"); // Redirect to the desired page after login
    }
}
}