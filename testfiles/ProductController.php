<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Category;
use App\Models\AlbumPhoto;
use App\Models\CategoryProduct;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\OrderProduct;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductFeature;
use Input;
use File;
use Redirect;
use DB;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App;
use Session;
use \Illuminate\Database\Eloquent\Collection;
use App\Ecommerce\helperFunctions;

/**
 * @Controller(domain="grace.reset")
 *
 */

class ProductController extends Controller
{
	public function __construct()
	{

		$this->middleware('sentinel.auth', ['except' => [
			'index',
			'show',
			'search'
		]]);
	}



	/**
	 * Show the Index Page
	 * @Get("/shop", as="shop")
	 */
	public function index()
	{
		$products = Product::all();
		$new_products = Product::orderBy('created_at', 'desc')->take(12)->get();
		$get_best_sellers = OrderProduct::select('product_id', \DB::raw('COUNT(product_id) as count'))->groupBy('product_id')->orderBy('count', 'desc')->take(8)->get();
		$best_sellers = [];
		foreach($get_best_sellers as $product){
			$best_sellers[] = $product->product;
		}
		//helperFunctions::getPageInfo($sections,$cart,$total);
		return view('frontend.shop.index', compact('new_products', 'best_sellers', 'sections', 'cart', 'total'));
	}



	public function show($id, $slug = null)
	{
		$product = Product::findBySlugOrIdOrFail($id);

		$product_categories = $product->categories()->lists('id')->toArray();

		// dd($product, $product->features, $product->categories, $product->prices, $product->options, $product->variants);
		$similair = Category::find($product_categories[array_rand($product_categories)])->products()->whereNotIn('id', [$id])->orderByRaw('RAND()')->take(6)->get();

		return view('frontend.shop.product', compact('sections', 'product', 'similair', 'cart', 'total'));
	}

	public function store(Request $request, Price $price)
	{


		/**
		 * Validate the submitted Data
		 */
		$this->validate($request, [
		//	'name' => 'required',
			//'manufacturer' => 'required',
			//'price' => 'required',
			//'details' => 'required',
			//'quantity' => 'required',
			//'categories' => 'required',
			//'thumbnail' => 'required|image',
		]);

		if ($request->hasFile('album')) {
			foreach ($request->album as $photo) {
				if ($photo && strpos($photo->getMimeType(), 'image') === false) {
					return \Redirect()->back();
				}
			}
		}

		/**
		 * Upload a new thumbnail
		 */
		$dest = "remove/";
		$name  = str_random(11) . '_' . $request->file('thumbnail')->getClientOriginalName();
		$request->file('thumbnail')->move($dest, $name);
		$name2 = str_random(11) . '_' . $request->file('thumbnail2')->getClientOriginalName();
		$request->file('thumbnail2')->move($dest, $name2);
	$input = Input::all();
	$product = $request->all();
		$product['thumbnail'] = '/' . $dest . $name;
		$product['thumbnail2'] = '/' . $dest . $name2;

//dd(Input::all());
		//$product->prices->price = Input::get('price');


//		$product_description = Input::get('description');


		$product = Product::create($product);
//
//		//dd($request->all());
//
////		$product = App\Models\Product::find(1);
//
//		/**
//		 * Upload Album Photos
//		 */
//		if ($request->hasFile('album')) {
//			foreach ($request->album as $photo) {
//				if ($photo) {
//					$name = str_random(11)."_".$photo->getClientOriginalName();
//					$photo->move($dest, $name);
//					AlbumPhoto::create([
//						'product_id' => $product->id,
//						'photo_src' => "/".$dest.$name,
//						'alt' => 'alt text',
//						'caption' => $name,
//						'photoinfo' => 'information about photo',
//						'linkto' => null,
//						'use_main' => 1,
//						'use_thumb' => 1,
//						'use_gallery' => 1,
//
//					]);
//				}
//			}
//		}



		/**
		 * Linking the categories to the product
		 */

		foreach ($request->categories as $category_id) {
			CategoryProduct::create(['category_id' => $category_id, 'product_id' => $product->id]);
		}

		/**
		 * Linking the options to the product
		 */

		if ($request->has('options')){
			foreach ($request->options as $option_details) {
				if (!empty($option_details['name']) && !empty($option_details['values'][0]) ) {
					$option = Option::create([
						'name' => $option_details['name'],
						'product_id' => $product->id
					]);
					foreach ($option_details['values'] as $value) {
						OptionValue::create([
							'value' => $value,
							'option_id' => $option->id
						]);
					}
				}
			}
		}
//
		if ($request->has('prices')){
			foreach ($request->prices as $pricing) {
				if (!empty($pricing['name'])) {
					$price = Price::create([
						'product_id' => $product->id,
						'title' => $pricing['title'],
						'price' => $pricing['price'],
						'model' => $pricing['model'],
						'sku' => $pricing['sku'],
						'upc' => $pricing['upc'],
						'quantity' => $pricing['quantity'],
						'alt_details' => $pricing['alt_details']

					]);
//
				}
			}
		}




//
//		if ($request->has('prices'))
//		{
//
//			foreach ($request->prices as $pricing)
//			{
//
//				$product_prices_id = $product->id;
//	            $product_prices_title = Input::get('title');
//	            $product_prices_price = Input::get('price');
//	            $product_prices_model = Input::get('model');
//	            $product_prices_sku = Input::get('sku');
//	            $product_prices_upc = Input::get('upc');
//	            $product_prices_quantity = Input::get('quantity');
//	            $product_prices_alt_details = Input::get('alt_details');
//
//	                $product_id = DB::table('prices')->insertGetId([
//			            'product_id' => $product_prices_id,
//			            'title' => $product_prices_title,
//			            'price' => $product_prices_price,
//			            'model' => $product_prices_model,
//			            'sku' => $product_prices_sku,
//			            'upc' => $product_prices_upc,
//			            'quantity' => $product_prices_quantity,
//			            'alt_details' =>$product_prices_alt_details
//		            ]);
//	        }
//	    }
//
		if(!empty($request->attribute_name)){
			foreach($request->attribute_name as $key => $item){
				$productVariant = new ProductVariant();
				$productVariant->attribute_name = $item;
				$productVariant->product_attribute_value = $request->product_attribute_value[$key];
				$product->productVariants()->save($productVariant);
			}
		}
//
//		var_dump($input);
		//FlashAlert()->success('Success!', 'The Product Was Successfully Added');

		return \Redirect(getLang() . '/admin/products');
	}

	public function edit(Request $request, $id)
	{
		$product = Product::find($id);
		/**
		 * Validate the submitted Data
		 */
		$this->validate($request, [
			'name' => 'required',
//			'manufacturer' => 'required',
//			'price' => 'required',
//			'details' => 'required',
//			'quantity' => 'required',
//			'categories' => 'required',
//			'thumbnail' => 'image',
		]);
		if ($request->hasFile('album')) {
			foreach ($request->album as $photo) {
				if ($photo && strpos($photo->getMimeType(), 'image') === false) {
					return \Redirect()->back();
				}
			}
		}

		/**
		 * Remove the old categories from the pivot table and maintain the reused ones
		 */
		$added_categories = [];
		foreach ($product->categories as $category) {
			if (!in_array($category->id, $request->categories)) {
				CategoryProduct::whereProduct_id($product->id)->whereCategory_id($category->id)->delete();
			} else {
				$added_categories[] = $category->id;
			}
		}

		/**
		 * Link the new categories to the pivot table
		 */
		foreach ($request->categories as $category_id) {
			if (!in_array($category_id, $added_categories)) {
				CategoryProduct::create(['category_id' => $category_id, 'product_id' => $product->id]);
			}
		}

		$info = $request->all();

		/**
		 * Upload a new thumbnail and delete the old one
		 */
		$dest = "content/images/";
		if ($request->file('thumbnail')) {
			File::delete(public_path().$product->thumbnail);
			$name = str_random(11)."_".$request->file('thumbnail')->getClientOriginalName();
			$request->file('thumbnail')->move($dest, $name);
			$info['thumbnail'] = "/".$dest.$name;
		}
		/**
		 * Upload Album Photos
		 */
		if ($request->hasFile('album')) {
			foreach ($request->album as $photo) {
				if ($photo) {
					$name = str_random(11)."_".$photo->getClientOriginalName();
					$photo->move($dest, $name);
					AlbumPhoto::create([
						'product_id' => $product->id,
						'photo_src' => "/".$dest.$name
					]);
				}
			}
		}

		$product->update($info);

		/**
		 * Linking the options to the product
		 */

		if ($request->has('options')){
			foreach ($request->options as $option_details) {
				if (!empty($option_details['name']) && !empty($option_details['values']['name'][0]) ) {
					if (isset($option_details['id']))
					{
						$size = count($option_details['values']['id']);
						Option::find($option_details['id'])->update(['name' => $option_details['name']]);
						foreach ($option_details['values']['name'] as $key => $value) {
							if ($key < $size)
							{
								OptionValue::find($option_details['values']['id'][$key])->update(['value' => $value]);
							}
							else
							{
								OptionValue::create([
									'value' => $value,
									'option_id' => $option_details['id']
								]);
							}
						}
					}
					else
					{
						$option = Option::create([
							'name' => $option_details['name'],
							'product_id' => $product->id
						]);
						foreach ($option_details['values']['name'] as $value) {
							if (!empty($value)) {
								OptionValue::create([
									'value' => $value,
									'option_id' => $option->id
								]);
							}
						}
					}
				}
			}
		}



		return \Redirect()->back()->with([
			'flash_message' => 'Product Successfully Modified'
		]);
	}

	public function delete($id)
	{
		$product = Product::find($id);

		/**
		 * Remove the product , all its linked categories and delete the thumbnail
		 */
		File::delete(public_path().$product->thumbnail);
		CategoryProduct::whereProduct_id($id)->delete();
		$product->delete();
		return \Redirect::back();
	}

	public function deletePhoto($id, $photo_id)
	{
		$photo = AlbumPhoto::find($photo_id);
		File::delete(public_path().$photo->photo_src);
		AlbumPhoto::destroy($photo_id);
		return \Redirect()->back();
	}

	public function deleteOption($id)
	{
		Option::destroy($id);
		return \Redirect()->back();
	}

	public function deleteOptionValue($id)
	{
		OptionValue::destroy($id);
		return \Redirect()->back();
	}

	public function search(Request $request)
	{
		if (strtoupper($request->sort) == 'NEWEST') {
			$products = Product::where('name', 'like', '%'.$request->q.'%')->orderBy('created_at', 'desc')->paginate(40);
		} elseif (strtoupper($request->sort) == 'HIGHEST') {
			$products = Product::where('name', 'like', '%'.$request->q.'%')->orderBy('price', 'desc')->paginate(40);
		} elseif (strtoupper($request->sort) == 'LOWEST') {
			$products = Product::where('name', 'like', '%'.$request->q.'%')->orderBy('price', 'asc')->paginate(40);
		} else {
			$products = Product::where('name', 'like', '%'.$request->q.'%')->paginate(40);
		}
		helperFunctions::getPageInfo($sections,$cart,$total);
		$query = $request->q;
		return view('site.search', compact('sections', 'cart', 'total', 'products', 'query'));
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function togglePublish($id)
	{
		$product = Product::find($id);

		$product->is_published = ($product->is_published) ? false : true;
		$product->save();

		return Response::json(array('result' => 'success', 'changed' => ($product->is_published) ? 1 : 0));
	}



	public function getTest()
	{
//		$products = Product::all()->toArray();
		$products = Product::orderBy('created_at', 'desc')->get();
		return view('frontend.shop.testindex');
	}


}
