<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use App\Business;
use App\User;
use App\State;
use App\MenuItem;

use App\Http\Controllers\Controller;
use App\businessImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Void_;
use Illuminate\Support\Facades\Mail;

use Session;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->hasRole('Administrator'))
            $businesses = Business::get();
        else
            $businesses = Business::where('user_id',auth()->user()->id)->get();
        return view('admin.business.index', compact('businesses'));
    }

    public function edit($id)
    {
        $categories = Category::all()->where('deleted_at', null)->where('is_active', 1);
        $states =State::all()->where('deleted_at', null)->where('is_active', 1);
        $users =User::all();

        $business = Business::findorFail($id);
        return view('admin.business.edit', compact(['business','users','states', 'categories']));
    }

    public function create() {
        $categories = Category::all()->where('deleted_at', null)->where('is_active', 1);
      
        return view('admin.business.create', compact(['categories']));
    }

    public function store(Request $request) {
        $validator = $this->doValidate($request);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();
     
        // $sku = $this->generateSKU($request->category,$request->slug);
        // $skuCheck = Validator::make(['sku' => $sku], [
        //     'sku' => ['required', 'string', 'max:255', 'unique:businesses,sku']
        // ]);
        // if($skuCheck->fails())
        //     $sku = null;
        // }
       
        $business = new Business();
       
        $this->insert($request, $business);
        Session::flash('success', "Business Created Successfully!");
        $lastInsertID = $business->id;
   
        return redirect()->route('admin.business.index');
    }

    public function variantIndex($id){
        $business_details = Business::findOrFail($id);
        $business_variations = MenuItem::all()->where('business_id',$id);
        return view('admin.business.variant-index',compact('business_details','business_variations'));
    }
    public function showvariant($id){
     
        // $business_details = Business::findOrFail($id);
        
        // $business_variations = Business::with('menuItems')->get();
        $business_details = Business::with('menuItems')->findOrFail($id);

// Load the related menu items
        return view('admin.business.variant-index',compact('business_details'));
    }
    
    public function createVariant($id){
        $business_details = Business::findOrFail($id);

        return view('admin.business.create-variant',compact('business_details'));
    }

    public function storeVariant(Request $request , $id){
     
        $validator = Validator::make($request->all(), [ 
    
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|gt:0',
            
        ],
        [ 
 
            'name.required' => 'Please provide name',
            'description.required' => 'Please provide description',
            'price.required' => 'please Provide price.',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $business_variations = new MenuItem();
        $business_variations->business_id = $id;
        $business_variations->name = $request->name;
        $business_variations->description = $request->description;
        $business_variations->price = $request->price ;
        if ($request->hasFile('var_image')) {
            $file = $request->file('var_image');
            $image = upload($file, 1280, 426, 'businesss');
            $business_variations->var_image = $image;
        }
        $business_variations->save();
        Session::flash('success','Variant Has Been Added Successfully');
        return redirect()->route('admin.business.showvariant',$id);
    }
    public function editVariant($id){
        $business_variant = MenuItem::findOrFail($id);
   
        return view('admin.business.edit-variant',compact('business_variant'));
    }

     public function updateVariant(Request $request,$id){
     
        $validator = Validator::make($request->all(), [ 
    
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|gt:0',
            
        ],
        [ 
 
            'name.required' => 'Please provide name',
            'description.required' => 'Please provide description',
            'price.required' => 'Please provide price',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
   
        $update_vatiants = MenuItem::findorFail($id);
        $update_vatiants->name = ($request->name != null)? $request->name: $request->name;
        $update_vatiants->description = ($request->description != null)? $request->description: $request->description;

        // $update_vatiants->var_price = ($request->var_price != null)? $request->var_price: $request->var_price;
               // $update_vatiants->var_shipping = ($request->var_shipping != null)? $request->var_shipping: $request->var_shipping;
        // $update_vatiants->var_reward_points = ($request->var_reward_points != null)? $request->var_reward_points: $request->var_reward_points;
        $update_vatiants->price = ($request->price != null)? $request->price: $request->price;
        if ($request->hasFile('var_image')) {
            $file = $request->file('var_image');
            $image = upload($file, 1280, 426, 'businesss');
            $update_vatiants->var_image = $image;
        }
        $update_vatiants->save();
        
        Session::flash('success','Variant Has Been Updated Successfully');
        return redirect()->route('admin.business.showvariant',$update_vatiants->business_id);
     }

    public function update(Request $request, Business $business)
    {
        $validator = $this->doValidate($request, $business);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $this->insert($request, $business);
        Session::flash('success', "business Updated Successfully!");
        return redirect()->route('admin.business.index');
    }

    public function show($id){
        $business_details = business::findOrFail($id);
        return view('admin.business.show',compact('business_details'));
    }
  

    public function destroy($id) {
        $business = Business::findorFail( $id );
        $business->delete();
        Session::flash('success', "business deleted Successfully!");
        return redirect()->back();
    }

    public function destroyvariant($id) {
        $business = MenuItem::findorFail( $id );
        $business->delete();
        Session::flash('success', "Variant deleted Successfully!");
        return redirect()->back();
    }


    public function feature($id) {
        $business = Business::findorFail($id);
        $business->is_featured = !$business->is_featured;
        $business->save();
        if($business->is_featured)
            Session::flash('success', "business is marked as featured successfully!");
        else
            Session::flash('success', "business is unmarked from featured business!");
        return redirect()->back();
    }

    public function descriptionImage(Request $request) {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            return env('APP_URL').upload($file, 553, 580, 'businesss/description');
        }
        return '';
    }
    
    // public function generateSKU( $categoryId, $slug) {
      
    //     if(sizeof(explode(' ', $slug)) > 1)
    //         $sku = strtoupper(explode(' ', $slug)[0][0].explode(' ', $slug)[1][0]);
    //     else
    //         $sku = strtoupper(explode(' ', $slug)[0][0].explode(' ', $slug)[0][1]);
    //     $sku .= $slug.'-';
    //     $category = Category::where('id', $categoryId)->first()->name;
    //     if(sizeof(explode(' ', $category)) > 1)
    //         $sku .= strtoupper(explode(' ', $category)[0][0].explode(' ', $category)[1][0]).'-';
    //     else
    //         $sku .= strtoupper(explode(' ', $category)[0][0].explode(' ', $category)[0][1]).'-';
    //     return $sku .= rand(11111, 999999999);
    // }

    public function doValidate(Request $request, $business = null) {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'website' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'map' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string','max:500'],
            'category' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'tags.*' => ['required', 'string', 'starts_with:#'], // Custom validation for each tag to start with #

        ];
        
        if($request->route()->getName() == 'admin.business.update') {
            $rules['slug'] = ['required', 'string', 'max:255', 'unique:businesses,slug,'.$business->id];
            $rules['logo'] = ['mimes:jpeg,jpg,png', 'max:500000'];
            $rules['business_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];
            $rules['business_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];
            $rules['business_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];
            $rules['tags.*'] = ['required', 'string', 'starts_with:#'];

            $rules['menu_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];

            $rules['interior_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];

            $rules['multi_image.*'] = ['mimes:jpeg,jpg,png', 'max:500000'];
        }
        else {
            $rules['slug'] = ['required', 'string', 'max:255', 'unique:businesses,slug'];
            $rules['logo'] = ['required','mimes:jpeg,jpg,png', 'max:500000'];
            $rules['business_image'] = ['required', 'mimes:jpeg,jpg,png', 'max:500000'];

            $rules['menu_image'] = ['required','mimes:jpeg,jpg,png', 'max:500000'];

            $rules['interior_image'] = ['required', 'mimes:jpeg,jpg,png', 'max:500000'];
            // $rules['multi_image'] = ['required'];
            $rules['multi_image.*'] = ['mimes:jpeg,jpg,png', 'max:500000'];
        }
     
        return Validator::make($request->all(), $rules, [
            'required' => 'business :attribute is required.',
            'unique' => 'Please Enter a unique Slug for your businesses.',
            'mimes' => 'Please enter a :attribute in either of the jpeg,jpg,png format.',
            'numeric' => 'business :attribute should be a Number.',
            'max' => 'Please Enter less than :max characters.',
            'integer' => 'business :attribute should be a Number.',
            'starts_with' => 'Tag start with #.'

        ]);
        
    }
    // public function deleteimage($id) {
    //     $image = businessImages::findorFail($id);
    //     $image->delete();
    //     Session::flash('message', "Image Remove!");
    //     return redirect()->back();
    // }



    public function insert(Request $businessData, $business) {
        $originalUserId = $business->user_id; // Store the original user_id before any updates

        
        $business->name = ($businessData['name'] != null)? $businessData['name']: $business->name;
        $business->slug = ($businessData['slug'] != null)? $businessData['slug']: $business->slug;
        $business->town = ($businessData['town'] != null)? $businessData['town']: $business->town;

        $business->website = ($businessData['website'] != null)? $businessData['website']: $business->website;
        $business->map = ($businessData['map'] != null)? $businessData['map']: $business->map;
        
        $business->email = ($businessData['email'] != null)? $businessData['email']: $business->email;
        $business->phone = ($businessData['phone'] != null)? $businessData['phone']: $business->phone;

        $business->start_time = ($businessData['start_time'] != null)? $businessData['start_time']: $business->start_time;
        $business->end_time = ($businessData['end_time'] != null)? $businessData['end_time']: $business->end_time;
        $business->address = ($businessData['address'] != null)? $businessData['address']: $business->address;
        $business->state_id = ($businessData['state'] != null)? $businessData['state']: $business->state_id;

       
        $business->category_id = ($businessData['category'] != null)? $businessData['category']: $business->category_id;
        $business->short_description = ($businessData['short_description'] != null)? $businessData['short_description']: $business->short_description;
        // $business->tags = ($businessData['tags'] != null) ? explode(',', $businessData['tags']) : $business->tags;

        $business->business_tags = ($businessData['tags'] != null)? implode('||',$businessData['tags']): $business->business_tags;

        // $business->business_tags = !empty($businessData['tags']) ? implode(',', $businessData['tags']) : $business->business_tags;
        
        if ($businessData['is_active'] == 'checked') {
            $business->is_active = 1;
        }
        else
            $business->is_active = 0;
            // if ($businessData['is_reviewable'] == 'checked') {
            //     $business->is_reviewable = 1;
            // }
            // else
            //     $business->is_reviewable = 0;
        if ($businessData->hasFile('logo')) {
            $file = $businessData->file('logo');
            $image = upload($file, 1280, 1280, 'bussines_logo');
            $business->logo = $image;
        }
        if ($businessData->hasFile('business_image')) {
            $file = $businessData->file('business_image');
            $image = upload($file, 1280, 1280, 'business_image');
            $business->business_image = $image;
        }
        if ($businessData->hasFile('menu_image')) {
            $file = $businessData->file('menu_image');
            $image = upload($file, 1280, 1280, 'menu_image');
            $business->menu_image = $image;
        }
        if ($businessData->hasFile('interior_image')) {
            $file = $businessData->file('interior_image');
            $image = upload($file, 1280, 1280, 'interior_image');
            $business->interior_image = $image;
        }
        if ($businessData['user'] && auth()->user()->hasRole('Seller')) {
            // Only update user_id if it's different from the original user_id
            if ($businessData['user'] != $originalUserId) {
                $business->user_id = $businessData['user'];
                $this->sendClaimEmail($business); // Send email only if user_id is updated
            }
        }
          $business->save();
        
        // if (isset($businessData['multi_image']) && $businessData['multi_image'] != null) {
        //     $business_images = businessImages::where('business_id',$business->id)->get();
        //     if (count($business_images) != null && count($business_images) > 0) {
        //         foreach ($business_images as $key => $value) {
        //             $business_images->each->delete();
        //         }
        //     }
        //     if ($businessData->hasFile('multi_image')) {
        //         $images = $businessData->file('multi_image');
        //         foreach ($images as $index => $value) {
        //             $business_image = new businessImages();
        //             $image_path = upload($value, 1200, 1200, 'businesss');
        //             $business_image->image = $image_path;
        //             $business_image->business_id = $business->id;
        //             $business_image->save();
        //         }
        //     }
        // }
    }

    protected function sendClaimEmail($business)
{
    // Assuming you're sending an email to the seller's email
    $sellerEmail = $business->user->email; // Get the seller's email
    $businessOwner = $business->user->first_name; // Get the seller's name (optional)

    // Send email to the business owner (Seller)
    Mail::send('front.claim_updated', ['business' => $business], function ($m) use ($sellerEmail, $businessOwner) {
        $m->from(env('MAIL_USERNAME'), 'Ideal-Spot');
        $m->to($sellerEmail, $businessOwner)->subject('Claim Updated: Business Ownership Changed');
    });
}
}
