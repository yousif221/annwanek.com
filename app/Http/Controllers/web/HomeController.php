<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\UserNotification; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\validateCaptcha; 
use App\Content;
use App\Category;
use App\Service;
use App\Banner;
use App\Product;
use App\Testimonial;
use App\Tournament;

use App\Portfolio;
use App\Slider;
use App\BookNowInquiry;
use App\Size;
use App\Slide;
use App\Claim;
use App\Blog;
use App\Business;
use App\MenuItem;
use App\Faqs;
use App\Heading;
use App\NewsLetter;
use App\Inquiry;
use App\ProductImages;
use App\ProductVariant;
use App\Reviews;
use App\State;
use App\Gallery;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use Auth;
use Stripe;
use Illuminate\Support\Facades\Mail;
use Str;
// use Artisan; 

class HomeController extends Controller

{
    
    

  
    

    public function index(Request $request,$column='id',$direction="asc")
    {
        
    //    \Artisan::call('storage:link');
        $banner    = Banner::where('Page','Index Page')->first();
        $recently_added= Business::where('is_active',1)->orderby('id','desc')->take(4)->get();
        $trendings= Business::where('is_active',1)->where('is_featured',1)->get();

        $slider    = Slider::where('page','Home Page')->get();
        $fav_cate      = Category::where('is_active',1)->where('is_featured',1)->get();
        $states      = State::where('is_active',1)->get();        
            
        $favourite_spot = Content::where('page','Home Page')->where('section','favourite spot')->first();
        $galleries      = Gallery::get();            

        $top_cities  = Content::where('page','Home Page')->where('section','Top Cities')->first();
        $blogs_content  = Content::where('page','Home Page')->where('section','Blog Updates By State')->first();
        $newsletter  = Content::where('page','Home Page')->where('section','Sign Up for New Updates')->first();

        $recently  = Content::where('page','Home Page')->where('section','Recently Added Spots')->first();

        $products      = Product::where('is_active',1)->where('is_featured',1)->get();
        $categories      = Category::where('is_active',1)->get();
        $products_featured      = Product::where('is_active',1)->with('productvar')->where('is_featured',1)->take(4)->get();
        
        $cat      = Category::where('is_active',1)->where('is_featured',1)->take(5)->get();
        $products_new      = Product::where('is_active',1)->where('is_featured', 1)->limit(4)->orderBy('id','asc')->get();
        $testimonials      = Testimonial::where('is_featured',1)->where('is_active',1)->orderby('rating','desc')->get();
        $trending  = Content::where('page','Home Page')->where('section','Trending Spots')->first();
        $new  = Content::where('page','Home Page')->where('section','new in store')->first();
        $blogs = Blog::where('is_active', 1)->get();

       
    
            return view('front.index',compact('blogs','trendings','recently_added','blogs_content','newsletter','galleries','states','top_cities','fav_cate','trending','slider','favourite_spot','products_new','new','cat','products','products_featured','categories','testimonials','recently','banner'));

        
    }  
    public function filter(Request $request)
{
    $stateId = $request->get('state_id');
    $blogs = Blog::where('state_id', $stateId)->with('state')->get();

    return response()->json([
        'blogs' => $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'description' => $blog->description,
                'primary_image' => $blog->primary_image,
                'state_name' => $blog->state->name,
                'username' => $blog->username,
                'created_at' => $blog->created_at->format('jS F Y'),
            ];
        }),
    ]);
}
     public function review(){
        $testimonials      = Testimonial::where('is_active',1)->orderby('rating','desc')->get();
        $slider    = Slider::where('page','Review Page')->get();

        $banner        = Banner::where('page','review')->first();
     return view('front.review',compact('slider','banner','testimonials'));    
    }
    public function faqs(){
        $faqs = Faqs::where('is_active',1)->get();

        $banner        = Banner::where('page','faqs')->first();
     return view('front.faqs',compact('banner','faqs'));    
    }
    public function Policy(){
        $policy  = Content::where('page','Policy Page')->where('section','policy')->first();

        $banner        = Banner::where('page','Policy')->first();
     return view('front.policy',compact('banner','policy'));    
    }
    public function categories()
    {
        $states = State::all();
        $categories = Category::all();
        $banner= Banner::where('page','Categories')->first();
        $categories= Category::where('is_active',1)->get();
        $content_1  = Content::where('page','Categories')->where('section','Categories')->first();
        $busineses= Business::where('is_active',1)->get();

       return view('front.categories',compact('banner','categories','states','busineses','categories','content_1'));
    }
 
    public function businessbycategory(Request $request, $slug)
{
    
    $banner = Banner::where('page', 'Categories')->first();
    $category = Category::where('slug', $slug)->first();
    $content_1 = Content::where('page', 'Categories')->where('section', 'Categories')->first();

    // Fetch businesses by category
    $query = Business::where('category_id', $category->id);

    // Apply state filter if provided via form or query parameter
    if ($request->has('state') && !empty($request->state)) {
        $query->where('state_id', $request->state);
    }

    // Get filtered businesses
    $businesses = $query->where('is_active',1)->get();

    // Fetch all states and categories for the filter dropdowns
    $states = State::all();
    $categories = Category::all();

    return view('front.businessbycategory', compact('banner', 'businesses', 'content_1', 'states', 'categories'));
}
public function filters(Request $request)
{
    $banner = Banner::where('page', 'Categories')->first();
    $content_1 = Content::where('page', 'Categories')->where('section', 'Categories')->first();

    // Fetch all states and categories for the dropdowns
    $states = State::all();
    $categories = Category::all();
    $find = State::where('name', 'LIKE', '%' . $request->state . '%')->first();
    $cat = Category::where('slug',  $request->category)->first();

    // Build the query for filtering businesses
    $query = Business::query();

    // Apply state filter if provided
    if ($request->has('state') && !empty($request->state)) {
        $query->where('state_id', $find->id);
    }

    // Apply category filter if provided
    if ($cat && $request->has('category') && !empty($request->category)) {
        $query->where('category_id', $cat->id);
    }

    // Apply search filter if provided
    // if ($request->has('search') && !empty($request->search)) {
    //     $query->where('name', 'LIKE', '%' . $request->search . '%');
    // }
    if ($request->has('search') && !empty($request->search)) {
        $query->where(function ($subQuery) use ($request) {
            $subQuery->where('name', 'LIKE', '%' . $request->search . '%')
                     ->orWhere('town', 'LIKE', '%' . $request->search . '%')
                     ->orWhere('address', 'LIKE', '%' . $request->search . '%')
  // Search for tags in the 'business_tags' column with '||' delimiter
  ->orWhere('business_tags', 'LIKE', '%' . $request->search . '%');        });
    }
    if ($request->has('city') && !empty($request->city)) {
        
        $query->where(function ($subQuery) use ($request) {
            $subQuery->where('town', 'LIKE', '%' . $request->city . '%');
                  

        });
    }
    // Get the filtered results
    $businesses  = $query->where('is_active',1)->get();

    return view('front.businessbycategory', compact('banner','content_1','businesses', 'states', 'categories'));
}
 
    // public function addbussiness(Request $request)
    // {
    //     if ($request->isMethod('GET')) {
    //           //     // If the method is GET, show the Add Business page
    //      $banner = Banner::where('page', 'Add Business')->first();
    //      $categories = Category::where('is_active', 1)->get();
    //      $states      = State::where('is_active',1)->get();        

    //         // Render the view for the business creation form
    //         return view('front.add-business',compact('banner','categories','states')); // Replace 'business.create' with the actual path to your view
    //     }
    
    //     if ($request->method() == 'POST') {
    //         // Validation rules
    //         $validator = Validator::make($request->all(), [
    //             'business_name' => 'required|string|max:255',
    //             'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'business_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'menu_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'interior_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'category_id' => 'required|exists:category,id',
    //             'start_time' => 'required|date_format:H:i',
    //             'end_time' => 'required|date_format:H:i|after:start_time',
    //             'address' => 'required|string|max:500',
    //             'checkbox' => 'accepted',
    //             'website_url' => 'nullable|url',
    //             'state' => 'required',

    //             'number' => 'nullable',
    //             'email' => 'nullable|email',
    //             'menu_items.*.name' => 'required|string|max:255',
    //             'menu_items.*.description' => 'required|string|max:1000',
    //             'menu_items.*.price' => 'required|numeric|min:0',
    //         ], [
    //             'category_id.required' => 'Please provide a category.',
    //             'menu_items.*.name.required' => 'Each menu item must have a name.',
    //             'menu_items.*.description.required' => 'Each menu item must have a description.',
    //             'menu_items.*.price.required' => 'Each menu item must have a price.',
    //         ]);
    
    //         // Handle validation errors
    //         if ($validator->fails()) {
    //             return response()->json(['success' => false, 'errors' => $validator->errors()]);
    //         }
    //         // Create the slug from the business name
    //         $slug = Str::slug($request->business_name);

    //         // Ensure the slug is unique
    //         $slugCount = Business::where('slug', $slug)->count();
    //         if ($slugCount > 0) {
    //             $slug = $slug . '-' . ($slugCount + 1); // Append a unique number if the slug already exists
    //         }
    //         // Save the business
    //         $business = new Business();
    //         $business->name = $request->business_name;
    //         $business->slug = $slug; // Save the generated slug
    //         $business->state_id = $request->state; // Save the generated slug

    //         $business->user_id = auth()->id();
    //         $business->category_id = $request->category_id;
    //         $business->start_time = $request->start_time;
    //         $business->end_time = $request->end_time;
    //         $business->address = $request->address;
    //         $business->website = $request->website_url;
    //         $business->phone = $request->number;
    //         $business->email = $request->email;
    
    //         // Handle file uploads
    //         $business->logo = $request->hasFile('logo') ? upload($request->file('logo'), 1280, 1280, 'business_logo') : null;
    //         $business->business_image = $request->hasFile('business_image') ? upload($request->file('business_image'), 1280, 1280, 'business_image') : null;
    //         $business->menu_image = $request->hasFile('menu_image') ? upload($request->file('menu_image'), 1280, 1280, 'menu_image') : null;
    //         $business->interior_image = $request->hasFile('interior_image') ? upload($request->file('interior_image'), 1280, 1280, 'interior_image') : null;
    
    //         $business->save();
    
    //         // Save menu items
    //         if ($request->menu_items) {
    //             foreach ($request->menu_items as $menuItem) {
    //                 $business->menuItems()->create([
    //                     'name' => $menuItem['name'],
    //                     'description' => $menuItem['description'],
    //                     'price' => $menuItem['price'],
    //                 ]);
    //             }
    //         }
    
    //         // Notify the admin
    //         $admin = User::where('role', 'admin')->first();
    //         \Notification::send($admin, new UserNotification($business));
    
    //         // Send email to user
    //         if ($request->email) {
    //             // Mail::send('front.invoice', ['business' => $business], function ($m) use ($business, $request) {
    //             //     $m->from(env('MAIL_USERNAME'), 'Ideal-Spot')
    //             //         ->to($request->email, 'User')
    //             //         ->subject('Business Added');
    //             // });
    //         }
    
    //         return response()->json(['success' => true, 'message' => 'Business added successfully!']);
    //     }
    // }
    
   

    
    // public function addbussiness(Request $request)
    // {
    //     if ($request->isMethod('GET')) {
    //         // Fetch necessary data for the view
    //         $banner = Banner::where('page', 'Add Business')->first();
    //         $categories = Category::where('is_active', 1)->get();
    //         $states = State::where('is_active', 1)->get();
    
    //         // Render the business creation form
    //         return view('front.add-business', compact('banner', 'categories', 'states'));
    //     }
    
    //     if ($request->method() == 'POST') {
    //         // Validation rules
    //         $validator = Validator::make($request->all(), [
    //             'business_name' => 'required|string|max:255',
    //             'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'business_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'menu_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'interior_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'category_id' => 'required|exists:category,id',
    //             'start_time' => 'required|date_format:H:i',
    //             'end_time' => 'required|date_format:H:i|after:start_time',
    //             'address' => 'required|string|max:500',
    //             'short_description'=>'required|max:255',
    //             'map' => 'required',
    //             'town'=>'required',
    //             'checkbox' => 'accepted',
    //             'website_url' => 'nullable|url',
    //             'state' => 'required',
    //             'number' => 'nullable',
    //             'email' => 'nullable|email',
    //             'menu_items.*.name' => 'required|string|max:255',
    //             'menu_items.*.description' => 'required|string|max:1000',
    //             'menu_items.*.price' => 'required|numeric|min:0',
    //         ], [
    //             'category_id.required' => 'Please provide a category.',
    //             'menu_items.*.name.required' => 'Each menu item must have a name.',
    //             'menu_items.*.description.required' => 'Each menu item must have a description.',
    //             'menu_items.*.price.required' => 'Each menu item must have a price.',
    //         ]);
    
    //         // Handle validation errors
    //         if ($validator->fails()) {
    //             return response()->json(['success' => false, 'errors' => $validator->errors()]);
    //         }
    
    //         DB::beginTransaction();
    
    //         try {
    //             // Generate and check the business slug
    //             $slug = Str::slug($request->business_name);
    //             $slugCount = Business::where('slug', $slug)->count();
    //             if ($slugCount > 0) {
    //                 $slug = $slug . '-' . ($slugCount + 1); // Make the slug unique
    //             }
    
    //             // Save the business
    //             $business = new Business();
    //             $business->name = $request->business_name;
    //             $business->town = $request->town;

                
    //             $business->slug = $slug;

    //             $business->state_id = $request->state;
    //             $business->short_description = $request->short_description;

    //             $business->user_id = auth()->id();
    //             $business->category_id = $request->category_id;
    //             $business->start_time = $request->start_time;
    //             $business->end_time = $request->end_time;
    //             $business->address = $request->address;
    //             $business->website = $request->website_url;
    //             $business->phone = $request->number;
    //             $business->email = $request->email;
    //             $business->map = $request->map;
                
    
    //             // Handle file uploads with a helper function
    //             $business->logo = $request->hasFile('logo') ? $this->uploadImage($request, 'logo', 'business_logo') : null;
    //             $business->business_image = $request->hasFile('business_image') ? $this->uploadImage($request, 'business_image', 'business_image') : null;
    //             $business->menu_image = $request->hasFile('menu_image') ? $this->uploadImage($request, 'menu_image', 'menu_image') : null;
    //             $business->interior_image = $request->hasFile('interior_image') ? $this->uploadImage($request, 'interior_image', 'interior_image') : null;
    
    //             $business->save();
    
    //             // Save menu items in batch
    //             if ($request->menu_items) {
    //                 $menuItems = collect($request->menu_items)->map(function ($item) use ($business) {
    //                     return [
    //                         'business_id' => $business->id,
    //                         'name' => $item['name'],
    //                         'description' => $item['description'],
    //                         'price' => $item['price'],
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ];
    //                 });
    
    //                 MenuItem::insert($menuItems->toArray());
    //             }
    
    //             DB::commit();
    
    //             // Notify the admin
    //             $admin = User::where('role', 'admin')->first();
    //             \Notification::send($admin, new UserNotification($business));
    
    //             // Optionally send email to the user
    //                 $email = $request->email;   
    //                 if($email){        
    //                 Mail::send('front.invoice', ['business' => $business], function ($m) use ($business, $email) {
    //                     $m->from(env('MAIL_USERNAME'), 'Ideal-Spot')
    //                         ->to($email, 'User')
    //                         ->subject('Business Added');
    //                 });
    //             }
    
    //             return response()->json(['success' => true, 'message' => 'Business added successfully!']);
    
    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => $e->getMessage(),
    //                 'line' => $e->getLine(),
    //                 'file' => $e->getFile(),
    //             ], 500);            }
    //     }
    // }
    public function addbussiness(Request $request)
{
    if ($request->isMethod('GET')) {
        // Fetch necessary data for the view
        $banner = Banner::where('page', 'Add Business')->first();
        $categories = Category::where('is_active', 1)->get();
        $states = State::where('is_active', 1)->get();

        // Render the business creation form
        return view('front.add-business', compact('banner', 'categories', 'states'));
    }

    if ($request->method() == 'POST') {
    
        // Validation rules
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'business_tags' => 'required', // Expect a JSON string from Tagify

            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'address' => 'required|string|max:500',
            'short_description'=>'required|max:255',
            'map' => 'required',
            'town'=>'required',
            'checkbox' => 'accepted',
            'website_url' => 'nullable|url',
            'state' => 'required',
            'number' => 'nullable',
            'email' => 'nullable|email',
            'menu_items.*.name' => 'required|string|max:255',
            'menu_items.*.description' => 'required|string|max:1000',
            'menu_items.*.price' => 'required|numeric|min:0',
        ], [
            'category_id.required' => 'Please provide a category.',
            'menu_items.*.name.required' => 'Each menu item must have a name.',
            'menu_items.*.description.required' => 'Each menu item must have a description.',
            'menu_items.*.price.required' => 'Each menu item must have a price.',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        DB::beginTransaction();

        try {
            // Generate and check the business slug after other data is saved
            $slug = Str::slug($request->business_name);
            $slugCount = Business::where('slug', $slug)->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1); // Make the slug unique
            }
      
        $tags = json_decode($request->input('business_tags'), true);
  
            // Save the business first (without images and menu items)
            $business = new Business();
            $business->name = $request->business_name;
            $business->town = $request->town;
            $business->slug = $slug;
            $business->state_id = $request->state;
            $business->short_description = $request->short_description;
            $business->user_id = auth()->id();
            $business->category_id = $request->category_id;
            $business->start_time = $request->start_time;
            $business->end_time = $request->end_time;
            $business->address = $request->address;
            $business->website = $request->website_url;
            $business->phone = $request->number;
            $business->email = $request->email;
            $business->map = $request->map;
            if (is_array($tags)) {
                // Extract tag values and implode them with '||' separator
                $tagValues = array_map(function($tag) {
                    return $tag['value'];  // Get 'value' from each tag
                }, $tags);
        
                // Implode the tags with '||' separator
                $tagsString = implode('||', $tagValues);
        
                // Save to your business model (adjust as needed for your setup)
           
                $business->business_tags = $tagsString;
             
            } 
            
            $business->save();
           
            // Handle file uploads with a helper function (you can optimize image handling here)
            if ($request->hasFile('logo')) {
                $business->logo = $this->uploadImage($request, 'logo', 'business_logo');
            }
            if ($request->hasFile('business_image')) {
                $business->business_image = $this->uploadImage($request, 'business_image', 'business_image');
            }
            if ($request->hasFile('menu_image')) {
                $business->menu_image = $this->uploadImage($request, 'menu_image', 'menu_image');
            }
            if ($request->hasFile('interior_image')) {
                $business->interior_image = $this->uploadImage($request, 'interior_image', 'interior_image');
            }
            $business->save();

            // Save menu items in batch after the business is created
            if ($request->menu_items) {
                $menuItems = collect($request->menu_items)->map(function ($item) use ($business) {
                    return [
                        'business_id' => $business->id,
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });

                MenuItem::insert($menuItems->toArray());
            }

            DB::commit();

            // Notify the admin
            $admin = User::where('role', 'admin')->first();
            \Notification::send($admin, new UserNotification($business));

            // Optionally send email to the user
            if ($request->email) {
                Mail::send('front.invoice', ['business' => $business], function ($m) use ($business, $request) {
                    $m->from(env('MAIL_USERNAME'), 'Ideal-Spot')
                        ->to($request->email, 'User')
                        ->subject('Business Added');
                });
            }

            return response()->json(['success' => true, 'message' => 'Business added successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
}

    /**
     * Helper function to handle file uploads.
     */
    private function uploadImage($request, $fieldName, $subFolder)
    {
        if ($request->hasFile($fieldName)) {
            // Generate a unique file name
            $fileName = uniqid() . '.' . $request->file($fieldName)->getClientOriginalExtension();
    
            // Store the file in the specified subfolder and return the path
            $path = $request->file($fieldName)->storeAs("public/images/{$subFolder}", $fileName);
    
            // Return the path relative to the storage folder
            return 'storage/images/' . $subFolder . '/' . $fileName;
        }
    
        return null;
    }
    public function  business($slug){
        $banner        = Banner::where('page','Business')->first();
        $business_detail= Business::where('slug',$slug)->first();
        $featured = Business::where('is_active',1)->where('is_featured',1)->get();
        $reviews = Reviews::where('business_id',$business_detail->id)->where('is_featured','1')->get();

            return view('front.business',compact('banner','reviews','featured','business_detail'));

        
    }
    public function  terms(){
        $banner        = Banner::where('page','terms')->first();
        $terms      = Content::where('page','terms')->where('section','terms')->first();
        $slider    = Slider::where('page','Terms and Condition')->get();

            return view('front.terms',compact('slider','banner','terms'));

        
    }
    
     
            public function Servicedetail(Request $request,$id){
                $service_detail = Service::where('id',$id)->first();
                $banner = Banner::where('page','Service Detail')->first();
                return view('front.service-detail',compact('banner','service_detail'));
            }
            public function product_two(Request $request, $slug = null)
            {
                $banner = Banner::where('page', 'Product')->first();
                $slider = Slider::where('page', 'Product Page')->get();
                $categories = Category::where('is_active', 1)->get();
            
                // Start with active products
                $query = Product::where('is_active', 1);
            
                // Category filtering
                if ($request->category) {
                    $category = Category::where('is_active', 1)->where('slug', $request->category)->first();
                    if ($category) {
                        $query->where('category_id', $category->id);
                    }
                }
            
                // Search filtering
                if ($request->search) {
                    $searchTerm = $request->search;
                    $query->where(function($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerm . '%');
                    });
                }
            
                // Sorting
                if ($request->sort) {
                    switch ($request->sort) {
                        case 'price_asc':
                            $query->orderBy('selling_price', 'asc');
                            break;
                        case 'price_desc':
                            $query->orderBy('selling_price', 'desc');
                            break;
                        case 'name_asc':
                            $query->orderBy('selling_price', 'asc');
                            break;
                        case 'name_desc':
                            $query->orderBy('selling_price', 'desc');
                            break;
                    }
                }
            
                // Pagination limit
                $limit = $request->limit ?? 10;
                $products = $query->paginate($limit);
            
                return view('front.products', compact('slider', 'categories', 'banner', 'products'));
            }
            
        public function productDetailPage(Request $request,$slug,$id){
            $product_det = Product::where('slug',$slug)->first();
            $stringData = explode(',', $product_det->product_tags);
            $banner        = Banner::where('page','Product Detail')->first();
            $reviews = Reviews::where('product_id',$product_det->id)->where('is_featured','1')->get();
         
            $product_variant=ProductVariant::where('product_id',$product_det->id)->get();
            $product_images = ProductImages::where('product_id',$product_det->id)->get();     
         return view('front.product-detail',compact('stringData','product_det','banner','product_images','reviews','product_variant'));    
        }
       
        public function filtersProducts(Request $request)
        {
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $selectedCategory = $request->category_id;
            $sorting = $request->sort;
           
            $products = Product::query();
    
            // Filter by price range
            if (!is_null($minPrice)) {
                $products->where('selling_price', '>=', $minPrice);
            }
    // Only apply max price filter if maxPrice is not null or empty
            if (!is_null($maxPrice) && $maxPrice !== '') {
                $products->where('selling_price', '<=', $maxPrice);   
            }
    
            // Filter by make
            if ($selectedCategory) {
                
                $products->where('category_id', $selectedCategory);
            }
            if($sorting=='featured'){
               
                $products->where('is_featured', 1);
            }
            if($sorting=='all'){
             
                $products->where('is_active', 1);
            }
     // Handle sorting
     if ($request->sort) {
        switch ($request->sort) {
          
            case 'price_asc':
                $products->orderBy('selling_price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('selling_price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            }
        }
            // Fetch filtered products
            $filteredProducts = $products->get();
    
            // Return filtered products as a partial view
            return view('front.filtered_products', compact('filteredProducts'));
        }






        public function reviews(Request $request){
            if ($request->method() == 'POST') {
    
                $validator = Validator::make($request->all(), [ 
                    'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u', 
                  
                    'email' => 'required|email',
                    'primaryImage' => [ 'mimes:jpeg,png,jpg,gif','max:2048'],
                    'food'=>'required',
                    'service'=>'required',
                    'value'=>'required',
                    'atmosphere'=>'required',

                    'reviews'=>'required',
                    
                    
                ],
                [
                    'reviews.required' => 'Please provide your  Reviews',
                    'description.required' => 'Please provide your  Description',
                    'inquiry_first_name.required' => 'Please provide your  name',
                    'inquiry_first_name.max' => ' name can not exceed :max characters',
                    'inquiry_first_name.regex' => 'Name can only contain alphabets',
                    'inquiry_email.required' => 'Please provide an Email',
                    'inquiry_email.email' => 'Email format is not correct',
                    'inquiry_email.regex'=>'Email format should be complete.',
                    'primaryImage.max'=> 'Your File must be 2MB',
                    'primaryImage.mimes'=>'Files must be jpeg,png,jpg,gif Format '
               
                   
                    
                ]);
                
                if ($validator->fails()){
                    Session::flash('error', $validator->errors()->first());
                    return redirect()->back()->withErrors($validator )->withInput();
                }
                $review = new Reviews();
                $review->business_id = $request->business;
                $review->food = $request->food;
                $review->service = $request->service;
                $review->atmosphere = $request->atmosphere;
                $review->value = $request->value;


                $review->first_name = $request->name;
                $review->email = $request->email;
                $review->review = $request->reviews;
    
                
                if ($request->hasFile('primaryImage')) {
                    $file = $request->file('primaryImage');
                    $image = upload($file, 100, 100, 'reviews');
                    $review->image = $image;
                }
            
                $review->save();
                if ($review->save()) {
                    Session::flash('message', 'Thank You For Review Our Business!');
                    return redirect()->back();
                }
            }
        }

        public function claim(Request $request){
            if ($request->method() == 'POST') {
    
                $validator = Validator::make($request->all(), [ 
                    'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u', 
                  
                    'email' => 'required|email',
                    'file' => 'required|mimes:doc,docx,pdf|max:5000', // Use valid MIME types

                    'description'=>'required',
                    
                    
                ],
                [
                    'reviews.required' => 'Please provide your  Reviews',
                    'description.required' => 'Please provide your  Description',
                    'inquiry_first_name.required' => 'Please provide your  name',
                    'inquiry_first_name.max' => ' name can not exceed :max characters',
                    'inquiry_first_name.regex' => 'Name can only contain alphabets',
                    'inquiry_email.required' => 'Please provide an Email',
                    'inquiry_email.email' => 'Email format is not correct',
                    'inquiry_email.regex'=>'Email format should be complete.',
                    'primaryImage.max'=> 'Your File must be 2MB',
                    'primaryImage.mimes'=>'Files must be jpeg,png,jpg,gif Format '
               
                   
                    
                ]);
                
                if ($validator->fails()){
                    Session::flash('error', $validator->errors()->first());
                    return redirect()->back()->withErrors($validator )->withInput();
                }
                $review = new Claim();
                $review->business_id = $request->business;
                $review->description = $request->description;
                $review->first_name = $request->name;
                $review->type ='Claim';

                $review->email = $request->email;
                $review->user_id =auth()->user()->id;
    
                
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Generate a unique filename

                    $filePath = $file->storeAs('claims', $fileName, 'public'); // Save file to storage/app/public/reports
                    $review->file = $filePath;
                }
            
                $review->save();
          
                if ($review->save()) {
                    $admin = User::where('role', 'admin')->first();
                    \Notification::send($admin, new UserNotification($review));
                    $data2['email'] = $request->email;
                    Mail::send('front.claim', ['review' => $review],function ($m) use ($review,$data2) {
                        $m->from(env('MAIL_USERNAME'), 'Ideal-Spot');
                        $m->to($data2["email"],'User')->subject('Claim');
                       
                    });

                    $data3['email'] = getConfig('primary_email');

                    Mail::send('front.claimadmin', ['review' => $review],function ($m) use ($review,$data3) {
                        $m->from(env('MAIL_USERNAME'), 'Ideal-Spot');
                        $m->to($data3["email"],'User')->subject('Claim');
                       
                    });
                    Session::flash('message', 'Thank you for submitting your claim! We will review your request and get back to you shortly.');
                    return redirect()->back();
                }
            }
        }



        public function newsletter(Request $request)
        {
            $validator = Validator::make($request->all(), [ 
                'newsletter_email' => 'required|email|unique:newsletters,newsletter_email'
            ],
            [ 
                'newsletter_email.unique' => 'This Email Address is already in our Subscribers List',
                'newsletter_email.required' => 'Enter Your Email Address.',
                'newsletter_email.regex'=>'Invalid Email Address',
            ]);
            if($validator->fails())
                return response()->json(['error' => $validator->errors()->first()]);
                $NewsLetter = new NewsLetter;
                $NewsLetter->newsletter_email = $request->newsletter_email;
                $NewsLetter->save();
                if ($NewsLetter->save()) {

                    $data2['email'] = $request->newsletter_email;
                    Mail::send('front.news', ['NewsLetter' => $NewsLetter],function ($m) use ($NewsLetter,$data2) {
                        $m->from(env('MAIL_USERNAME'), 'The Bowling Society');
                        $m->to($data2["email"],'User')->subject('Newletter Subscription ');
                       
                    });
                return response()->json(['success' => true,]);
                }
             }


             
             public function tournaments(Request $request){
            
                    $banner = Banner::where('page','Tournament Page')->first();
                    $content  = Content::where('page','Appointment')->where('section','Appointment')->first();
                    $tour    = Tournament::where('is_active',1)->get();

                    $slider    = Slider::where('page','Tournament Page')->get();
                    
                        return view('front.tournament',compact('tour','banner','slider','content'));

                    }

                    public function viewwishlist()
                    {
                        $wishlist = session()->get('wishlist', []); // Retrieve wishlist from session
                        $products = Product::whereIn('id', array_keys($wishlist))->get(); // Get products in the wishlist
                        $banner = Banner::where('page','Wish List')->first();

                        return view('front.wishlist', compact('products','banner')); // Pass products to the view
                    }
                
                    // Add a product to the wishlist
                    public function addwish($productId)
                    {
                        $wishlist = session()->get('wishlist', []);
                
                        // If the product is not already in the wishlist, add it
                        if (!isset($wishlist[$productId])) {
                            $wishlist[$productId] = ['id' => $productId]; // You can add more info here if needed
                            session()->put('wishlist', $wishlist);
                            return redirect()->back()->with('message', 'Product is added to wishlist!');

                        }
                        return redirect()->back()->with('error', 'Product is already in wishlist!');

                    }
                
                    // Remove a product from the wishlist
                    public function removewish($productId)
                    {
                        $wishlist = session()->get('wishlist', []);
                
                        if (isset($wishlist[$productId])) {
                            unset($wishlist[$productId]);
                            session()->put('wishlist', $wishlist);
                            return redirect()->back()->with('message', 'Product is removed from wishlist!');

                        }
                
                        return response()->json(['message' => 'Product not found in wishlist!'], 404);
                    }




                    public function blogs()
                    {
                     
                  
                        // $cartData = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id);
                        $banner= Banner::where('page','Blogs')->first();
                        $blogs= Blog::where('is_active',1)->get();
                        $states      = State::where('is_active',1)->get();        

                            return view('front.blogs',compact('states','banner','blogs'));
                        
                    }
                    
                    public function blogdetail(Request $request,$id)
                    {
                
                    
                  
                        // $cartData = \Cart::session(auth()->user()->id)->getContent(auth()->user()->id);
                        $banner= Banner::where('page','Blogs Details Page')->first();
                        $blogs= Blog::where('id',$id)->first();
                        $slider    = Slider::where('page','Blog-detail')->get();

                            return view('front.blog-detail',compact('slider','banner','blogs'));
                        
                    }

}