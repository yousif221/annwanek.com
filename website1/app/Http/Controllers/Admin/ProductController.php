<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use App\Product;
use App\Size;
use App\Weight;
use App\ProductVariant;

use App\Http\Controllers\Controller;
use App\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Void_;

use Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->hasRole('Administrator'))
            $products = Product::paginate(20);
        else
            $products = Product::where('user_id',auth()->user()->id)->get();
        return view('admin.product.index', compact('products'));
    }

    public function edit($id)
    {
        $categories = Category::all()->where('deleted_at', null)->where('is_active', 1);
    
        $product = Product::findorFail($id);
        $product_images = ProductImages::all()->where('product_id',$id);
        return view('admin.product.edit', compact(['product', 'categories','product_images']));
    }

    public function create() {
        $categories = Category::all()->where('deleted_at', null)->where('is_active', 1);
      
        return view('admin.product.create', compact(['categories']));
    }

    public function store(Request $request) {
        $validator = $this->doValidate($request);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();
        do {
        $sku = $this->generateSKU($request->category,$request->slug);
        $skuCheck = Validator::make(['sku' => $sku], [
            'sku' => ['required', 'string', 'max:255', 'unique:products,sku']
        ]);
        if($skuCheck->fails())
            $sku = null;
        }while($sku == null);
        $product = new Product();
        $product->sku = $sku;
       
        $this->insert($request, $product);
        Session::flash('success', "Product Created Successfully!");
        $lastInsertID = $product->id;
   
        return redirect()->route('admin.product.index');
    }

    public function variantIndex($id){
        $product_details = Product::findOrFail($id);
        $product_variations = ProductVariant::all()->where('product_id',$id);
        return view('admin.product.variant-index',compact('product_details','product_variations'));
    }
    public function showvariant($id){
        $product_details = Product::findOrFail($id);
        $product_variations = ProductVariant::all()->where('product_id',$id);
        return view('admin.product.variant-index',compact('product_details','product_variations'));
    }
    
    public function createVariant($id){
        $product_details = Product::findOrFail($id);
        $weights  = Weight::all()->where('is_active',1);

        $size = Size::all()->where('is_active',1);
        return view('admin.product.create-variant',compact('weights','product_details','size'));
    }

    public function storeVariant(Request $request , $id){
     
        $validator = Validator::make($request->all(), [ 
    
            'variant_value' => 'required|string|max:255',
            'var_stock' => 'required|numeric',
            'var_sku' => 'required|string|max:255',
            'variant_type'=>'required',
        ],
        [ 
 
            'variant_value.required' => 'Please provide variant value',
            'var_stock.required' => 'Please provide variant stock',
            'var_stock.numeric' => 'The variant stock must be in numbers.',
            'var_sku.required' => 'Please provide variant sku',
            'var_sku.max' => 'sku cannot exceed :max characters',
            'var_image.required' => 'Please provide variant image',
            'var_image.mimes' => 'variant image should be a :mimes',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product_variations = new ProductVariant();
        $product_variations->product_id = $id;
        $product_variations->attribute_type = $request->variant_type;
        $product_variations->attribute_value = $request->variant_value;
        $product_variations->var_stock = $request->var_stock ;
        $product_variations->var_sku = $request->var_sku ;
        if ($request->hasFile('var_image')) {
            $file = $request->file('var_image');
            $image = upload($file, 1280, 426, 'products');
            $product_variations->var_image = $image;
        }
        $product_variations->save();
        Session::flash('success','Variant Has Been Added Successfully');
        return redirect()->route('admin.product.showvariant',$id);
    }
    public function editVariant($id){
        $product_variant = ProductVariant::findOrFail($id);
   
        return view('admin.product.edit-variant',compact('product_variant'));
    }

     public function updateVariant(Request $request,$id){
     
        $validator = Validator::make($request->all(), [ 
    
            'variant_type' => 'required|string|max:255',
            'variant_value' => 'required|string|max:255',
            'var_stock' => 'required|numeric',
            'var_sku' => 'required|string|max:255',
        ],
        [ 
 
            'variant_type.required' => 'Please provide variant type',
            'var_price.required' => 'Please provide variant price',
            'var_price.numeric' => 'The variant price must be in numbers.',
            'var_stock.required' => 'Please provide variant stock',
            'var_stock.numeric' => 'The variant stock must be in numbers.',
            'var_sku.required' => 'Please provide variant sku',
            'var_sku.max' => 'sku cannot exceed :max characters',
            'var_image.required' => 'Please provide variant image',
            'var_image.mimes' => 'variant image should be a :mimes',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
   
        $update_vatiants = ProductVariant::findorFail($id);
        $update_vatiants->attribute_value = ($request->variant_value != null)? $request->variant_value: $request->variant_value;
        $update_vatiants->attribute_type = ($request->variant_type != null)? $request->variant_type: $request->variant_type;

        // $update_vatiants->var_price = ($request->var_price != null)? $request->var_price: $request->var_price;
               // $update_vatiants->var_shipping = ($request->var_shipping != null)? $request->var_shipping: $request->var_shipping;
        // $update_vatiants->var_reward_points = ($request->var_reward_points != null)? $request->var_reward_points: $request->var_reward_points;
        $update_vatiants->var_stock = ($request->var_stock != null)? $request->var_stock: $request->var_stock;
        $update_vatiants->var_sku = ($request->var_sku != null)? $request->var_sku: $request->var_sku;
        if ($request->hasFile('var_image')) {
            $file = $request->file('var_image');
            $image = upload($file, 1280, 426, 'products');
            $update_vatiants->var_image = $image;
        }
        $update_vatiants->save();
        
        Session::flash('success','Variant Has Been Updated Successfully');
        return redirect()->route('admin.product.showvariant',$update_vatiants->product_id);
     }

    public function update(Request $request, Product $product)
    {
        $validator = $this->doValidate($request, $product);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $this->insert($request, $product);
        Session::flash('success', "Product Updated Successfully!");
        return redirect()->route('admin.product.index');
    }

    public function show($id){
        $product_details = Product::findOrFail($id);
        return view('admin.product.show',compact('product_details'));
    }
  

    public function destroy($id) {
        $product = Product::findorFail( $id );
        $product->delete();
        Session::flash('success', "Product deleted Successfully!");
        return redirect()->back();
    }

    public function destroyvariant($id) {
        $product = ProductVariant::findorFail( $id );
        $product->delete();
        Session::flash('success', "Variant deleted Successfully!");
        return redirect()->back();
    }


    public function feature($id) {
        $product = Product::findorFail($id);
        $product->is_featured = !$product->is_featured;
        $product->save();
        if($product->is_featured)
            Session::flash('success', "Product is marked as featured successfully!");
        else
            Session::flash('success', "Product is unmarked from featured product!");
        return redirect()->back();
    }

    public function descriptionImage(Request $request) {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            return env('APP_URL').upload($file, 553, 580, 'products/description');
        }
        return '';
    }
    
    public function generateSKU( $categoryId, $slug) {
      
        if(sizeof(explode(' ', $slug)) > 1)
            $sku = strtoupper(explode(' ', $slug)[0][0].explode(' ', $slug)[1][0]);
        else
            $sku = strtoupper(explode(' ', $slug)[0][0].explode(' ', $slug)[0][1]);
        $sku .= $slug.'-';
        $category = Category::where('id', $categoryId)->first()->name;
        if(sizeof(explode(' ', $category)) > 1)
            $sku .= strtoupper(explode(' ', $category)[0][0].explode(' ', $category)[1][0]).'-';
        else
            $sku .= strtoupper(explode(' ', $category)[0][0].explode(' ', $category)[0][1]).'-';
        return $sku .= rand(11111, 999999999);
    }

    public function doValidate(Request $request, $product = null) {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string','max:500'],
            'description' => [],
            'category' => ['required', 'integer'],
            'additionalinfo' => [],
            'selling_price' => ['required',  'numeric','gt:0'],
            'old_price' => ['required',  'numeric','gt:0'],
            'stock' => ['required', 'integer'],
            // 'tags' => ['required','array'],
            // 'tags.*' => ['string','max:255'],
        ];
        if($request->route()->getName() == 'admin.product.update') {
            $rules['slug'] = ['required', 'string', 'max:255', 'unique:products,slug,'.$product->id];
            $rules['featured_image'] = ['mimes:jpeg,jpg,png', 'max:500000'];
            $rules['multi_image.*'] = ['mimes:jpeg,jpg,png', 'max:500000'];
        }
        else {
            $rules['slug'] = ['required', 'string', 'max:255', 'unique:products,slug'];
            $rules['featured_image'] = ['mimes:jpeg,jpg,png', 'required', 'max:500000'];
            $rules['multi_image'] = ['required'];
            $rules['multi_image.*'] = ['mimes:jpeg,jpg,png', 'max:500000'];
        }
        if(auth()->user()->hasRole('Administrator')) {
            if($request->input('is_active') == 'checked')
                $rules['selling_price'] = ['required', 'numeric','gt:0'];
        }
        else {
            $rules['selling_price'] = ['required', 'numeric','gt:0'];
        }
        return Validator::make($request->all(), $rules, [
            'required' => 'Product :attribute is required.',
            'unique' => 'Please Enter a unique Slug for your Product.',
            'mimes' => 'Please enter a :attribute in either of the jpeg,jpg,png format.',
            'numeric' => 'Product :attribute should be a Number.',
            'max' => 'Please Enter less than :max characters.',
            'integer' => 'Product :attribute should be a Number.'
        ]);
    }
    public function deleteimage($id) {
        $image = ProductImages::findorFail($id);
        $image->delete();
        Session::flash('message', "Image Remove!");
        return redirect()->back();
    }



    public function insert(Request $productData, $product) {
        $product->name = ($productData['name'] != null)? $productData['name']: $product->name;
        $product->slug = ($productData['slug'] != null)? $productData['slug']: $product->slug;
        $product->short_description = ($productData['short_description'] != null)? $productData['short_description']: $product->short_description;
        $product->description = ($productData['description'] != null)? $productData['description']: $product->description;
        $product->additional_info = ($productData['additionalinfo'] != null)? $productData['additionalinfo']: $product->additional_info;
        $product->selling_price = ($productData['selling_price'] != null)? $productData['selling_price']: $product->selling_price;
        $product->category_id = ($productData['category'] != null)? $productData['category']: $product->category_id;
        $product->stock = ($productData['stock'] != null)? $productData['stock']: $product->stock;
        $product->actual_price = ($productData['old_price'] != null)? $productData['old_price']: $product->old_price;
        // $product->product_tags = ($productData['tags'] != null)? implode('||',$productData['tags']): $product->product_tags;

        // $product->product_tags = !empty($productData['tags']) ? implode(',', $productData['tags']) : $product->product_tags;
        
        if ($productData['is_active'] == 'checked') {
            $product->is_active = 1;
        }
        else
            $product->is_reviewable = 0;
            if ($productData['is_reviewable'] == 'checked') {
                $product->is_reviewable = 1;
            }
            else
                $product->is_reviewable = 0;
        if ($productData->hasFile('featured_image')) {
            $file = $productData->file('featured_image');
            $image = upload($file, 1280, 1280, 'products');
            $product->image = $image;
        }
        $product->user_id = (auth()->user()->hasRole('Seller')) ? auth()->user()->id : $product->user_id;
        $product->save();
        
        if (isset($productData['multi_image']) && $productData['multi_image'] != null) {
            $product_images = ProductImages::where('product_id',$product->id)->get();
            if (count($product_images) != null && count($product_images) > 0) {
                foreach ($product_images as $key => $value) {
                    $product_images->each->delete();
                }
            }
            if ($productData->hasFile('multi_image')) {
                $images = $productData->file('multi_image');
                foreach ($images as $index => $value) {
                    $product_image = new ProductImages();
                    $image_path = upload($value, 1200, 1200, 'products');
                    $product_image->image = $image_path;
                    $product_image->product_id = $product->id;
                    $product_image->save();
                }
            }
        }
    }
}
