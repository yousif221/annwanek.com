<?php

namespace App\Http\Controllers\web;
use App\Notifications\UserNotification; 
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Banner;
use App\Order;
use App\Orderitem;
use App\Coupon;
use App\ProductVariant;
// use App\Country;
use Session;
use App\Slider;
use DB;
use Auth;
use Carbon\Carbon;
use Stripe;
use App\Http\Stripe\vendor\autoload;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function cartPage()
    {
        \Cart::removeCartCondition('discount');
        
        if (Auth::check()) {
            $cartData = \Cart::session(auth()->user()->id)->getContent();
            $condition = \Cart::session(auth()->user()->id)->getCondition('discount');
        } else {
            $userId = Session::get('cart_session_id');
            if (!$userId) {
                $userId = uniqid();
                Session::put('cart_session_id', $userId);
            }
    
            $cartData = \Cart::session($userId)->getContent();
           
            $condition = \Cart::session($userId)->getCondition('discount');
        }

         $lastIndex = $cartData->last();
    
     
        $banner = Banner::where('page', 'Cart')->first();
        $slider = Slider::where('page', 'Cart')->get();

        if ($cartData->isNotEmpty()) {
            // Render the cart page with cart data if the cart is not empty
            return view('front.cart', compact('lastIndex', 'cartData','slider', 'banner'))
                ->with('message', 'Product Has Been Added To Your Cart.');
        } else {
            // Redirect to the homepage if the cart is empty
            return redirect()->route('webIndexPage')  ->with('error', 'Your Cart Is Empty.');
        }
    }
     
     
//     public function AddToCart(Request $request)
//     {
// dd($request->all());
//         $product_id = $request->product_id;
//         $prodVariants = ProductVariant::where('product_id', $product_id)->get();
    
//         // Validation setup based on attribute presence
//         $validationRules = [];
//         $validationMessages = [];

    
//     // Loop through the attributes sent in the request to create validation rules
//     foreach ($request->input('attributes', []) as $attributeType => $attributeValue) {
//         // Check if the attribute exists in the product variants
//         $attributeExists = $prodVariants->contains(function($prod) use ($attributeType, $attributeValue) {
//             return $prod->attribute_type == $attributeType && $prod->attribute_value == $attributeValue;
//         });

//         // If the attribute exists in the request but doesn't exist in the product variants, add a validation rule
//         if (!$attributeExists) {
//             $validationRules["attributes.{$attributeType}"] = 'required';
//             $validationMessages["attributes.{$attributeType}.required"] = "Invalid selection for {$attributeType}.";
//         }
//     }

//     // If an attribute is missing in the request, mark it as required
//     foreach ($prodVariants as $prod) {
//         // Check if the product variant has attributes, and if it's not in the request, mark it as required
//         $attributeType = $prod->attribute_type;

//         // If attribute is missing in the request and exists in the variants
//         if (!array_key_exists($attributeType, $request->input('attributes', []))) {
//             $validationRules["attributes.{$attributeType}"] = 'required';
//             $validationMessages["attributes.{$attributeType}.required"] = "Please select a value for {$attributeType}.";
//         }
//     }
//         // Apply validation if there are rules to validate
//         if (!empty($validationRules)) {
//             $validator = Validator::make($request->all(), $validationRules, $validationMessages);
//             if ($validator->fails()) {
//                 Session::flash('error', $validator->errors()->first());
//                 return redirect()->back()->withErrors($validator)->withInput();
//             }
//         }
    
//         // Check if the user is logged in for cart management
//         if (Auth::check()) {
//             $allcarts = \Cart::session(auth()->user()->id)->getContent();
    
//             foreach ($allcarts as $allcart) {
//                 // Check for existing product and matching attributes
//                 if (
//                     $allcart->associatedModel == $product_id &&
//                     $allcart->attributes->attribute_type == $request->attribute_type &&
//                     $allcart->attributes->attribute_value == $request->attribute_value
//                 ) {
//                     return redirect()->back()->with('error', 'This Product is Already in Cart');
//                 }
//             }
//         }
    
//         // Determine quantity
//         $quantity = $request->quantity > 1 ? $request->quantity : 1;
    
//         // Retrieve the main product and its variant if needed
//         $product = Product::where('id', $product_id)->first();
//         $product_variant = ProductVariant::where('product_id', $product_id)
//             ->where('attribute_type', $request->attribute_type)
//             ->where('attribute_value', $request->attribute_value)
//             ->first();
    
//         // Stock validation
//         if ($product_variant && $product_variant->var_stock < $quantity) {
//             return redirect()->back()->with('error', 'The Remaining Product Variant Quantity is ' . $product_variant->var_stock);
//         } elseif (!$product_variant && $product->stock < $quantity) {
//             return redirect()->back()->with('error', 'The Remaining Product Quantity is ' . $product->stock);
//         }
    
//         // Prepare data for cart entry
//         $cartAttributes = [
//             'image' => $product->image,
//             'category_id' => $product->category_id,
//             'sku' => $product->sku,
//             'attribute_type' => $request->attribute_type,
//             'attribute_value' => $request->attribute_value,
//         ];
    
//         // Add to cart based on user or guest
//         if (Auth::check()) {
//             $cartData = \Cart::session(auth()->user()->id)->add([
//                 'id' => uniqid(),
//                 'name' => $product->name,
//                 'price' => $product->selling_price,
//                 'image' => $product->image,
//                 'quantity' => $quantity,
//                 'attributes' => $cartAttributes,
//                 'associatedModel' => $product->id,
//             ]);
//         } else {
//             $guestCartSessionId = Session::get('cart_session_id', uniqid());
//             Session::put('cart_session_id', $guestCartSessionId);
    
//             $cartData = \Cart::session($guestCartSessionId)->add([
//                 'id' => uniqid(),
//                 'name' => $product->name,
//                 'price' => $product->selling_price,
//                 'image' => $product->image,
//                 'quantity' => $quantity,
//                 'attributes' => $cartAttributes,
//                 'associatedModel' => $product->id,
//             ]);
//         }
    
//         // Redirect to cart page with success message if added
//         if ($cartData) {
//             $banner = Banner::where('page', 'Cart')->first();
//             return redirect('cartPage')->with('message', 'This Product added into cart');
//         }
//     }
    
public function AddToCart(Request $request)
{
    $product_id = $request->product_id;
    $prodVariants = ProductVariant::where('product_id', $product_id)->get();
    
    // Validation rules and messages
    $validationRules = [];
    $validationMessages = [];
    
    $attributes = $request->input('attributes', []);
    
    // Ensure attributes is an array
    if (!is_array($attributes)) {
        $attributes = [];  // Default to an empty array if it's not an array
    }
    
    // Iterate through each product variant to check for required attributes
    foreach ($prodVariants as $prod) {
        $attributeType = $prod->attribute_type;
    
        // If attribute is missing in the request and exists in the variants
        if (!array_key_exists($attributeType, $attributes)) {
            // Add validation rule for missing attribute
            $validationRules["attributes.{$attributeType}"] = 'required';
            $validationMessages["attributes.{$attributeType}.required"] = "Please select a value for {$attributeType}.";
        } elseif (array_key_exists($attributeType, $attributes)) {
            // If the attribute exists in the request, check if it's valid
            $attributeId = $attributes[$attributeType];
            $attributeExists = $prodVariants->contains(function ($prodVariant) use ($attributeType, $attributeId) {
                return $prodVariant->attribute_type == $attributeType && $prodVariant->id == $attributeId;
            });
    
            if (!$attributeExists) {
                // If the attribute doesn't exist for the selected variant, mark it as invalid
                $validationRules["attributes.{$attributeType}"] = 'required';
                $validationMessages["attributes.{$attributeType}.required"] = "Invalid selection for {$attributeType}.";
            }
        }
    }
    
    // Perform validation if any attributes are selected
    if (!empty($validationRules)) {
        $validator = Validator::make($request->all(), $validationRules, $validationMessages);
        if ($validator->fails()) {

            // Debugging: Log validation failure to help debug
            Session::flash('error', $validator->errors()->first());
               return redirect()->back()->withErrors($validator)->withInput();        }
    }
    
    // Ensure the `attributes` input is a valid array and perform the cart check
    $userId = Auth::id() ?? Session::get('cart_session_id', uniqid());
    $existingCart = \Cart::session($userId)->getContent()->filter(function ($cartItem) use ($product_id, $request) {
        // Ensure we're comparing valid arrays by using json_encode
        $cartAttributes = json_encode($cartItem->attributes);
        $requestAttributes = json_encode($request->input('attributes', []));  // Ensure attributes is an array
    
        return $cartItem->associatedModel == $product_id && $cartAttributes == $requestAttributes;
    });
    
    // Debugging: Log cart check
    \Log::info("Existing cart items", ['existingCart' => $existingCart->toArray()]);
    
    if ($existingCart->isNotEmpty()) {
        return redirect()->back()->with('error', 'This product is already in the cart.');
    }
    
    // Fetch product and variant details
    $product = Product::find($product_id);
    $product_id = $request->product_id;
    $attributes = $request->input('attributes', []);
    
    // Ensure attributes is an array
    if (!is_array($attributes)) {
        $attributes = [];
    }
    
    // Initialize an array to store the names of attributes with unavailable stock
    $attributeNames = [];
    
    // Loop through each attribute to check stock availability
    foreach ($attributes as $attributeType => $attributeId) {
        // Find the variant based on product_id, attribute_type, and attribute_value (attribute_id)
        $selectedVariant = ProductVariant::where('product_id', $product_id)
            ->where('attribute_type', $attributeType)
            ->where('id', $attributeId)
            ->first();

        // If the variant doesn't exist or stock is 0 or less, add the attribute to the error list
        if (!$selectedVariant || $selectedVariant->var_stock <= 0) {
            $attributeNames[] = ucfirst($attributeType); // Add attribute name to error message
        }
    }
    $quantity = (isset($request->quantity) && $request->quantity > 1) ? $request->quantity : 1;

    // If there are any attributes with unavailable stock, generate the error message
    if (count($attributeNames) > 0) {
        $attributeNamesString = implode(', ', $attributeNames);
        $stockMessage = "The selected product variant with attributes {$attributeNamesString} is unavailable due to insufficient stock.";
    
        return redirect()->back()->with('error', $stockMessage);
    }elseif($product->stock < $quantity){
        return redirect()->back()->with('error','The Remaining Product Quantity is '.$product->stock);

    }

    $cartAttributes = [
        'image' => $product->image, // Include the product's image
        'category_id' => $product->category_id,
        'sku' => $product->sku,
        'attributes' => $request->input('attributes'), // Store selected attributes
    ];
            
    // Add to cart
    \Cart::session($userId)->add([
        'id' => uniqid(),
        'name' => $product->name,
        'price' => $product->selling_price,
        'quantity' => max(1, $request->quantity),
        'attributes' => $cartAttributes,
        'associatedModel' => $product->id,
    ]);

    return redirect('cartPage')->with('message', 'Product added to cart successfully!');
}

    
// public function AddToCart(Request $request)
// {
//     $product_id = $request->product_id;
//     $prodVariants = ProductVariant::where('product_id', $product_id)->get();
    
//     // Validation setup based on attribute presence
//     $validationRules = [];
//     $validationMessages = [];

//     // Loop through the attributes sent in the request to create validation rules
//     foreach ($request->input('attributes', []) as $attributeType => $attributeValue) {
//         // Check if the attribute exists in the product variants
//         $attributeExists = $prodVariants->contains(function($prod) use ($attributeType, $attributeValue) {
//             return $prod->attribute_type == $attributeType && $prod->attribute_value == $attributeValue;
//         });

//         // If the attribute exists in the request but doesn't exist in the product variants, add a validation rule
//         if (!$attributeExists) {
//             $validationRules["attributes.{$attributeType}"] = 'required';
//             $validationMessages["attributes.{$attributeType}.required"] = "Invalid selection for {$attributeType}.";
//         }
//     }

//     // If an attribute is missing in the request, mark it as required
//     foreach ($prodVariants as $prod) {
//         // Check if the product variant has attributes, and if it's not in the request, mark it as required
//         $attributeType = $prod->attribute_type;

//         // If attribute is missing in the request and exists in the variants
//         if (!array_key_exists($attributeType, $request->input('attributes', []))) {
//             $validationRules["attributes.{$attributeType}"] = 'required';
//             $validationMessages["attributes.{$attributeType}.required"] = "Please select a value for {$attributeType}.";
//         }
//     }

//     // Apply validation if there are rules to validate
//     if (!empty($validationRules)) {
//         $validator = Validator::make($request->all(), $validationRules, $validationMessages);
//         if ($validator->fails()) {
//             Session::flash('error', $validator->errors()->first());
//             return redirect()->back()->withErrors($validator)->withInput();
//         }
//     }

//     // Check if the user is logged in for cart management
//     if (Auth::check()) {
//         $allcarts = \Cart::session(auth()->user()->id)->getContent();

//         foreach ($allcarts as $allcart) {
//             // Check for existing product and matching attributes
//             if (
//                 $allcart->associatedModel == $product_id &&
//                 $allcart->attributes == $request->attributes // Updated to check the whole attributes array
//             ) {
//                 return redirect()->back()->with('error', 'This Product is Already in Cart');
//             }
//         }
//     }

//     // Determine quantity
//     $quantity = $request->quantity > 1 ? $request->quantity : 1;

//     // Retrieve the main product and its variant if needed
//     $product = Product::where('id', $product_id)->first();
//     $product_variant = ProductVariant::where('product_id', $product_id)
//         ->where($this->mapAttributes($request->attributes)) // Map attributes for the variant search
//         ->first();

//     // Stock validation
//     if ($product_variant && $product_variant->var_stock < $quantity) {
//         // Retrieve all attribute types and values for the variant
//         $attributes = $product_variant->attributes_type; // Assuming this is a JSON or array containing attributes
//         $attributesText = 'N/A';
    
//         if (is_array($attributes) || is_object($attributes)) {
//             $attributesText = collect($attributes)
//                 ->map(function ($value, $key) {
//                     return ucfirst($key) . ': ' . ucfirst($value);
//                 })
//                 ->join(', ');
//         }
    
//         return redirect()->back()->with(
//             'error',
//             'The Remaining Product Variant Quantity for (' . $attributesText . ') is ' . $product_variant->var_stock
//         );
//     } elseif (!$product_variant && $product->stock < $quantity) {
//         return redirect()->back()->with(
//             'error',
//             'The Remaining Product Quantity is ' . $product->stock
//         );
//     }
//     // Prepare data for cart entry
//     $cartAttributes = [
//         'image' => $product->image,
//         'category_id' => $product->category_id,
//         'sku' => $product->sku,
//         'attributes' => $request->input('attributes', []), // Updated to pass the full attributes array
//     ];

//     // Add to cart based on user or guest
//     if (Auth::check()) {
//         $cartData = \Cart::session(auth()->user()->id)->add([
//             'id' => uniqid(),
//             'name' => $product->name,
//             'price' => $product->selling_price,
//             'image' => $product->image,
//             'quantity' => $quantity,
//             'attributes' => $cartAttributes,
//             'associatedModel' => $product->id,
//         ]);
//     } else {
//         $guestCartSessionId = Session::get('cart_session_id', uniqid());
//         Session::put('cart_session_id', $guestCartSessionId);

//         $cartData = \Cart::session($guestCartSessionId)->add([
//             'id' => uniqid(),
//             'name' => $product->name,
//             'price' => $product->selling_price,
//             'image' => $product->image,
//             'quantity' => $quantity,
//             'attributes' => $cartAttributes,
//             'associatedModel' => $product->id,
//         ]);
//     }

//     // Redirect to cart page with success message if added
//     if ($cartData) {
//         $banner = Banner::where('page', 'Cart')->first();
//         return redirect('cartPage')->with('message', 'This Product added into cart');
//     }
// }

// Helper method to map attributes for product variant search
private function mapAttributes($attributes)
{
    $conditions = [];
    foreach ($attributes as $type => $value) {
        $conditions[] = ['attribute_type' => $type, 'attribute_value' => $value];
    }

    return $conditions;
}


    public function CheckOutPage(Request $request)
    {
       
        if ($request->method() == 'POST') {
            if (auth()->check()){
                $FileAddedToCart = \Cart::session(auth()->user()->id)->update($request->last_ID, array(
                    'total' => $request->total,
                ));
            }
            else{
                $FileAddedToCart = \Cart::update($request->last_ID, array(
                    'total' => $request->total,
               
                ));
            }
       
            if ($FileAddedToCart) {
                return redirect('/CheckOutPage');
            }
        }
        if (Auth::check()) {
            $cartData = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id);
        
        }
        else{
            $cartData = \Cart::getContent();
         
        }
        $lastIndex = '';
        foreach ($cartData as $key => $value) {
            $lastIndex = $value;
        }
        $banner = Banner::where('page','Check Out')->first();
        $slider    = Slider::where('page','Check Out')->get();

        // $countries = Country::all();
        return  view('front.checkout',compact('banner','cartData','slider'));
    }

    public function billingInfoPage(Request $request){
        if ($request->method() == 'POST') {
            if (auth()->check()){
                $FileAddedToCart = \Cart::session(auth()->user()->id)->update($request->last_ID, array(
                    'holder' => $request->auth()->user()->id,
                ));
            }
            else{
                $FileAddedToCart = \Cart::update($request->last_ID, array(
                    'holder' => $request->optionsRadios,
                ));
            }

            if ($FileAddedToCart) {
                return redirect('/billing-information');
            }
        }
        if (Auth::check()) {
            $cartData = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id);
        }
        else{
            $cartData = \Cart::getContent();
        }
        $lastIndex = '';
        foreach ($cartData as $key => $value) {
            $lastIndex = $value;
        }

        $banner = Banner::where('page','CheckOut Page')->first();
        return ($lastIndex != null)? view('front.billing-info',compact('cartData','lastIndex','banner')): redirect('/');
    }

    public function updatecart(Request $request)
    {
       
        $validator = Validator::make($request->all(), [ 
                
            'value' => 'integer|gt:0', 
        ],
        [ 
            'value.gt' => ' Value Must Be Greater Than 0',
     
        ]);
              
        if ($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withErrors($validator )->withInput();
        }
        
        $value = (isset($request->value) && $request->value > 1) ? $request->value : 1;
 
        $target_product = $request->target_product;
        $prod=ProductVariant::where('product_id',$target_product)->first();
     
        if ($request->all() != null) {
            if (Auth::check()) {
                $cart_data_to_check = \Cart::session(auth()->user()->id)->getContent($target_product);
               
                $save_product_id = '';
                foreach ($cart_data_to_check as $key => $cartdata) {
                    if ($cartdata->id == $target_product) {
                        $save_product_id = $cartdata->associatedModel;
                    }
                }
                $product_quantity_check = Product::findOrfail($save_product_id);
              
                $prod=ProductVariant::where('product_id',$product_quantity_check->id)->first();
          
                if(!$prod){
                if ($product_quantity_check->stock < $value){
                return redirect()->back()->with('error','The Remaining Product Quantity is '.$product_quantity_check->stock);
                  }  
                }else{
      
             
                    if($prod->var_stock < $value){
                        return redirect()->back()->with('error','The Remaining Product Variant Quantity is '.$prod->var_stock);
                    }
                }
                $FileAddedToCart = \Cart::session(auth()->user()->id)->update($target_product,
                    array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $value
                        )
                    ));
                    return redirect()->back()->with('info','Product Quantity Has Been Updated in your Cart');
            }
            else{
                $userId = Session::get('cart_session_id');
                $cart_data_to_check = \Cart::session($userId)->getContent();

                $save_product_id = '';
                foreach ($cart_data_to_check as $key => $cartdata) {
                    if ($cartdata->id == $target_product) {
                        $save_product_id = $cartdata->associatedModel;
                    }
                }
                $product_quantity_check = Product::findOrfail($save_product_id);
              
                $prod=ProductVariant::where('product_id',$product_quantity_check->id)->first();
          
                if(!$prod){
                if ($product_quantity_check->stock < $value){
                return redirect()->back()->with('error','The Remaining Product Quantity is '.$product_quantity_check->stock);
                  }  
                }else{
      
             
                    if($prod->var_stock < $value){
                        return redirect()->back()->with('error','The Remaining Product Variant Quantity is '.$prod->var_stock);
                    }
                }
                $FileAddedToCart = \Cart::update($target_product,
                    array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $value
                        )
                    ));
                    return redirect()->back()->with('info','Product Quantity Has Been Updated in your Cart');

            }
        }
    }

    public function DeleteFromCart($id)
    {
        if (Auth::check()) {
            // Remove the specified item from the authenticated user's cart session
            \Cart::session(auth()->user()->id)->remove($id);
            
            // Get the updated cart content
            $cartData = \Cart::session(auth()->user()->id)->getContent();
    
            // If the cart is empty, remove the discount condition
            if ($cartData->isEmpty()) {
                \Cart::session(auth()->user()->id)->clearCartConditions();
            }
        } else {
            // For guest users, retrieve or generate a session ID
            $userId = Session::get('cart_session_id');
            if ($userId) {
                // Remove the specified item from the guest user's cart session
                \Cart::session($userId)->remove($id);
    
                // Get the updated cart content
                $cartData = \Cart::session($userId)->getContent();
    
                // If the cart is empty, remove the discount condition
                if ($cartData->isEmpty()) {
                    \Cart::session($userId)->clearCartConditions();
                }
            }
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('info', 'Product Has Been Removed From Your Cart');
    }

    public function Discount(Request $request){
        
        $discounts = Coupon::where('discount_code',$request->discount)->first();

        $discount_code = '';
        $discount_id = 0;
        // $discount_code = $value->discount_code;
        if ($discounts !=null && $discounts->discount_code == $request->discount) {
            if (Carbon::now()->toDateTimeString() >= $discounts->start_date && Carbon::now()->toDateTimeString() <= $discounts->end_date && $discounts->max_usage > 0) {
                if ($request->cart_total >= $discounts->min_required_amount) {
                    if($discounts->discount_type == 'fixed_amount'){
                        $discount_id = $discounts->id;
                        $discounted_price = $request->cart_total - $discounts->discount;
                        if (Auth::check()) {
                            // $FileAddedToCart = \Cart::session(auth()->user()->id)->update('6537ed3ecbf8f', array(
                            //     'discounted_total' => $discounted_price,
                            //     'coupon_name' => $request->discount,
                            //     'discount_price' => $discounts->discount,
                            // ));

                            $FileAddedToCart = new \Darryldecode\Cart\CartCondition(array(
                                'name' => 'discount',
                                // 'name' => $request->discount,
                                'type' => $discounts->discount_type,
                                'target' => $discounted_price, // this condition will be applied to cart's subtotal when getSubTotal() is called.
                                'value' => $discounts->discount,
                                'attributes' => array( 
                                        'coupon' => $request->discount,
                                        'maxdiscount' => $discounts->max_discount,
                                    ),
                            ));
                            \Cart::session(auth()->user()->id)->condition($FileAddedToCart);
                        }
                        else{
                            // $FileAddedToCart = \Cart::update($request->last_id, array(
                            //     'discounted_total' => $discounted_price,
                            //     'coupon_name' => $request->discount,
                            //     'discount_price' => $discounts->discount,
                            // ));
                            $FileAddedToCart = new \Darryldecode\Cart\CartCondition(array(
                                'name' => 'discount',
                                // 'name' => $request->discount,
                                'type' => $discounts->discount_type,
                                'target' => $discounted_price, // this condition will be applied to cart's subtotal when getSubTotal() is called.
                                'value' => $discounts->discount,
                                'attributes' => array( 
                                        'coupon' => $request->discount,
                                        'maxdiscount' => $discounts->max_discount,
                                    ),
                            ));
                            \Cart::session(auth()->user()->id)->condition($FileAddedToCart);
                        }
                        if ($FileAddedToCart) {
                            $coupon_user = Coupon::where('id',$discount_id)->first();

                            $remaining_user = $coupon_user->max_usage - 1;

                            Coupon::where('id', $discount_id)

                            ->update([

                                'max_usage' => $remaining_user,

                            ]);

                            $coupon_user->save();

                            return redirect('cartPage')->with('message','Your Coupon '.$request->discount.' is applied to Your cart');

                        }

                    }

                    else{

                        $discount_id = $discounts->id;

                        $discounted_applied = $request->cart_total * ( $discounts->discount / 100 );

                        $discounted_price = $request->cart_total - round($discounted_applied);
                        $FileAddedToCart = new \Darryldecode\Cart\CartCondition(array(
                            'name' => 'discount',
                            // 'name' => $request->discount,
                            'type' => $discounts->discount_type,
                            'target' => $discounted_price, // this condition will be applied to cart's subtotal when getSubTotal() is called.
                            'value' => $discounts->discount,
                            'attributes' => array( 
                                    'coupon' => $request->discount_code,
                                    'maxdiscount' => $discounts->max_discount,  
                                ),
                        ));
                        \Cart::session(auth()->user()->id)->condition($FileAddedToCart);

                        if ($FileAddedToCart) {

                            $coupon_user = Coupon::where('id',$discount_id)->first();

                            $remaining_user = $coupon_user->max_usage - 1;

                            Coupon::where('id', $discount_id)

                            ->update([

                                'max_usage' => $remaining_user,

                            ]);

                            $coupon_user->save();

                            return redirect('cartPage')->with('message','Your Coupon '.$request->discount.' is applied to Your cart');

                        }

                    }

                }else{

                    return redirect()->back()->with('info','This Coupon is valid for price greater than $'.$discounts->min_required_amount);

                }

            }

            else{

                return redirect()->back()->with('info','This Coupon is no longer valid');

            }

        }

        else{

            return redirect()->back()->with('info','Invalid Coupon');

        }

    }



    public function viewOrder(){

        $order = Order::orderBy('id', 'DESC')->first();;

        $orderitems = Orderitem::where('order_id',$order->id)->get();

        $banner = Banner::where('page','Order Page')->first();

        return view('front.orders',compact('banner','order','orderitems'));

    }



    public function placeOrder(Request $request){
    
        if($request->method() == 'POST'){
        
            $validator = Validator::make($request->all(), [ 
                
                'billing_first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255', 

              
                'billing_town_city' => 'required', 
                'billing_last_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255', 
                'billing_email' => 'required|email',
                'billing_contact' => 'required|max:255',
                'billing_address_1' => 'required|string|max:255',
                'billing_address_2' => 'max:255',
                'billing_country' => 'required|string|max:255',
                'billing_state' => 'required',
                'billing_zip' => 'required|max:5',
               
            ],
            [ 
                'billing_first_name.required' => 'Please Provide First Name',
                'billing_first_name.max' => 'First Name can not exceed :max characters',
                'billing_last_name.required' => 'Please Provide Last Name',
                'billing_last_name.max' => 'First Name can not exceed :max characters',
                'billing_contact.required' => 'Please Provide a Contact',
                
                'billing_email.required' => 'Please provide An Email',
                'billing_email.email' => 'Email Should be in proper format',
                'billing_address_1.required' => 'Please Provide Address 1',
                'billing_address_1.max' => 'Address can not exceed :max characters',
             
                'billing_address_2.max' => 'Address can not exceed :max characters',
                'billing_state.required' => 'Please Provid a State',
                'billing_zip.max' => 'Zip code can not exceed :max characters',
                'billing_country.required' => 'Please Provid a country',
                'billing_town_city.required'=> 'Please Provid a City',
                'billing_company_name.regex'=> 'Company Name Format is Not Correct',
               
            ]);
          
            if ($validator->fails()){
                Session::flash('error', $validator->errors()->first());
                return redirect()->back()->withErrors($validator )->withInput();
            }
            if (Auth::check()) {
                $cartData = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id);
                $cartData_count = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id)->count();   
    
            }
            else{
                return redirect()->back()->with('error','first you have to login or signup then you can purchase our product thank you');

            }

           
            $order = new Order;
            
            $order->order_number = base_convert(time(),10,16);
            $order->order_status = 0;
            $order->user_id = (auth()->check()) ? auth()->user()->id : 'guest';
            $order->type = $request->type;
            $order->billing_first_name = $request->billing_first_name;
            $order->billing_last_name = $request->billing_last_name;
            $order->billing_contact = $request->billing_contact;
            $order->billing_email = $request->billing_email;
            $order->billing_address1 = $request->billing_address_1; 
            $order->billing_address2 = $request->billing_address_2;
            $order->billing_state = $request->billing_state;
            $order->billing_zipcode = $request->billing_zip;
            $order->billing_country = $request->billing_country;
            $order->billing_town_city = $request->billing_town_city;
            $order->billing_company_name = $request->billing_company_name;    
            $order->save();
            $admin = User::where('role', 0)->first();
            \Notification::send($admin, new UserNotification($order));
            $product_cart_quantity = 1;
            $quantity=0;
            $total=0;
            $subtotal=0;
           
            foreach ($cartData as $key => $value) {
                // dd($value);
                $quantity = $quantity+$value->quantity;
                // dd($value->attributes['attributes']); // Check if this outputs the expected array


                $subtotal = $subtotal+($value->quantity*$value->price);

          
          
                $order_items = new Orderitem;
                $order_items->user_id = $order->user_id;
                $order_items->order_id = $order->id;
                $order_items->name =  $value->name;
                $order_items->price =  $value->price;
                $order_items->quantity =  $value->quantity;
                $order_items->image =  $value->attributes['image'];
                $order_items->category_id =  $value->attributes['category_id'];
                $order_items->sku =  $value->attributes['sku'];
                $order_items->attributes = json_encode(array_values($value->attributes['attributes']));

                       
                $order_items->save();
                $product_updated = ProductVariant::where('product_id', $value->associatedModel)
                ->whereIn('id', $value->attributes['attributes']) // Check against the array of variant IDs
                ->get(); // Get all matching variants
                $productss = Product::where('id', $value->associatedModel)->first();
              

          
            if ($product_updated->isNotEmpty()) {
                // If ProductVariants exist, reduce stock for each
                foreach ($product_updated as $variant) {
                    // Reduce the stock for each variant
                    $variant->var_stock = $variant->var_stock - $value->quantity;
                    $variant->save();
                }
            } 
                
                    // Reduce stock for the main Product
                    $productss->stock = $productss->stock - $value->quantity;
                    $productss->save();

            
                if (Auth::check()) {
                    \Cart::session(auth()->user()->id)->remove($value->id);
                }else{
                    \Cart::remove($value->id);
                }
                $product_cart_quantity++;
            }
            $order_items = Orderitem::where('order_id',$order->id)->get();
            $condition = \Cart::getCondition('discount');
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', env('STRIPE_SECRET')));  
            if($condition){
                if($condition->getType() == 'percent'){
                    $total=$subtotal-($subtotal*($condition->getValue()/100));
                    \Cart::removeCartCondition('discount');
                }else{
                    $total=$subtotal-($condition->getValue());
                    \Cart::removeCartCondition('discount');
                }
            }else{
                $total = $subtotal;
            }
                Order::where('id',$order->id)
                ->update([
                    'quantity' => $quantity,
                    'Total' => $total,
                    'subtotal' => $subtotal,  
                    'order_pay' => 0,
                ]);
                try {
                    // Use Stripe's library to make requests...
                    $payment = \Stripe\PaymentIntent::create([
                        'amount' => (($total > 0)? $total: 1) * 100,
                        'currency' => 'gbp',
                        'payment_method' => $request->input('payId'),
                        'confirm' => true,  
                        'receipt_email' => $request->input('billing_email'),
                        'automatic_payment_methods' => [
                            'enabled' => true,
                            'allow_redirects' => 'never'
                        ],
                    ]);
                  } catch(\Stripe\Exception\CardException $e) {
                    // Since it's a decline, \Stripe\Exception\CardException will be caught
                    // echo 'Status is:' . $e->getHttpStatus() . '\n';
                    // echo 'Type is:' . $e->getError()->type . '\n';
                    // echo 'Code is:' . $e->getError()->code . '\n';
                    // // param is '' in this case
                    // echo 'Param is:' . $e->getError()->param . '\n';
                    // echo 'Message is:' . $e->getError()->message . '\n';

                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error','Your Order Has Been Placed But Payment Not Success'.$e->getError()->message);

                  } catch (\Stripe\Exception\RateLimitException $e) {
                    // Too many requests made to the API too quickly
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error','Too many requests made to the API too quickly'.$e->getError()->message);
                  } catch (\Stripe\Exception\InvalidRequestException $e) {
                    // Invalid parameters were supplied to Stripe's API
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error','An invalid request occurred.'.$e->getError()->message);
                  } catch (\Stripe\Exception\AuthenticationException $e) {
                    // Authentication with Stripe's API failed
                    // (maybe you changed API keys recently)
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error',' Authentication with Stripe  API failed'.$e->getError()->message);
                  } catch (\Stripe\Exception\ApiConnectionException $e) {
                    // Network communication with Stripe failed
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error',' Network communication with Stripe failed'.$e->getError()->message);
                  } catch (\Stripe\Exception\ApiErrorException $e) {
                    // Display a very generic error to the user, and maybe send
                    // yourself an email
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error','Your Order Has Been Placed But Payment Not Success'.$e->getError()->message);
                  } catch (Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                    return redirect()->route('webIndexPage')->with('error','Something else happened, completely unrelated to Stripe'.$e->getError()->message);
                  }
                if($payment['status'] == 'succeeded'){
                    $transaction_id = $payment['id'];
                    Order::where('id',$order->id)
                    ->update([
                        'transaction_id' => $transaction_id,
                        'order_pay' => 1,
                    ]);
                }else{
                    Order::where('id',$order->id)
                    ->update([
                        'order_pay' => 2,
                    ]);
                }
            
                $order = Order::where('id',$order->id)->first();
                $data2['email'] = $request->billing_email;
                Mail::send('front.invoice', ['order' => $order,'order_items'=>$order_items ],function ($m) use ($order,$order_items,$data2) {
                    $m->from(env('MAIL_USERNAME'), 'pierce-me');
                    $m->to($data2["email"],'User')->subject('Order Invoice');
                   
                });
            // return redirect('/CheckOutPage/'.$order->id);
            return redirect()->route('webIndexPage')->with('message','Your Order Has Been Placed Successfully');
        }
    }
    public function paymentPage($id){
        $order = Order::findOrFail($id);
        if($order->payment_info != null && $order->payment_status != null){
            return redirect('/');
        }
        return view('front.payment',compact('order'));
    }
    public function createPage(Request $request){
        // require('/home/democustomlinks/public_html/k7track_dev/app/Stripe/vendor/autoload.php');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        function calculateOrderAmount(array $items): int {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            return 1400;
        }
        // header('Content-Type: application/json');
        try {
            $order = Order::findOrfail($request->custom);
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' =>  $order->total * 100,
                'description' => 'Order Placed',
                'currency' => 'USD',
                'metadata' => [
                    'Order Number' => $order->order_number,
                    'Name' => $order->billing_first_name,
                    'Email' => $order->billing_email,
                    'Contact Number' => $order->billing_contact,
                    'Address' => $order->billing_address1 .' '. $order->billing_address2,
                    'City' => $order->billing_city,
                    'State' => $order->billing_state,
                    'Country' => $order->billing_country,
                    'Zipcode' => $order->billing_zipcode,
                  ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function thankyouPage(Request $request){
        if ($request->method() == "POST") {
            // $product_name = array();
            // $product_price = array();
            // $product_quantity = array();
            // $username = '';
            $order = Order::findOrFail($request->custom);
            // $email =  $order->billing_email;
            // $order_items = Orderitem::where('order_id',$request->custom)->get();
            // if (Auth::check()) {
            //     $username = auth()->user()->first_name .' '. auth()->user()->last_name;
            // }
            // else{
            //     $username = 'Non Register/ Guest Profile';
            // }
            // foreach ($order_items as $key => $item) {
            //     $product_name[] = $item->name;
            //     $product_price[] = $item->price;
            //     $product_quantity[] = $item->quantity;
            // }
            // $data = array(
            //     'username' => $username,
            //     'item_quantity' => count($order_items),
            //     'total_price' => $order->total,
            //     'order_number' => $order->order_number,
            //     'billing_name' => $order->billing_first_name .' '. $order->billing_last_name,
            //     'billing_contact' => $order->billing_contact,
            //     'billing_email' => $order->billing_email,
            //     'billing_address_1' => $order->billing_address1,
            //     'billing_address_2' => $order->billing_address2,
            //     'billing_city' => $order->billing_city,
            //     'billing_state' => $order->billing_state,
            //     'billing_country' => $order->billing_country,
            //     'billing_zip' => $order->billing_zipcode,
            //     'product_name' => $product_name,
            //     'product_quantity' => $product_quantity,
            //     'product_price' => $product_price,
            //     'actionURL' => url('https://demo-customlinks.com/clarabelle-hair-boutique/login')
            // );
            // Mail::send('mail.order_mail', $data, function ($message) use ($data) {
            //     $message->to('mackasauser@gmail.com','mack')
            //         ->subject('New Order Info')
            //         ->from('info@fashion_express.com','Fashion Express');
                // });
            $order->payment_info =serialize($request->all());
            $order->payment_status ='paid';
            $order->save();
            if ($order->save()) {
                return response()->json(['success' => true,]);
            }
        }
        $banner = Banner::where('page','Thankyou')->first();
        return view('front.thankyou',compact('banner'));
    }
}