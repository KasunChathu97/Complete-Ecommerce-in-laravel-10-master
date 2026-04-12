<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured=Product::where('status','active')->where('is_featured',1)->orderBy('price','DESC')->limit(2)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->orderBy('id','DESC')->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        $homepageMarquee = PostTag::where('slug', 'homepage-marquee')->first();

        if (!$homepageMarquee) {
            $homepageOfferText = 'අද දින 20% ක වට්ටමක්. ඔබත් ඉක්මනින් ඇණවුම් කරන්න.';
        } elseif ($homepageMarquee->status === 'active') {
            $homepageOfferText = $homepageMarquee->title;
        } else {
            $homepageOfferText = null;
        }
        // return $category;
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('product_lists',$products)
            ->with('category_lists',$category)
            ->with('homepage_offer_text', $homepageOfferText);
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        if (!$product_detail) {
            abort(404);
        }

        // dd($product_detail);
        return view('frontend.pages.product_detail', [
            'product_detail' => $product_detail,
        ]);
    }

    public function productGrids(Request $request){
        $products=Product::query();
                // Availability filter
                if(!empty($request->query('availability'))){
                    $availability = (array) $request->query('availability');
                    if(in_array('in_stock', $availability) && !in_array('out_of_stock', $availability)){
                        $products->where('stock', '>', 0);
                    } elseif(!in_array('in_stock', $availability) && in_array('out_of_stock', $availability)){
                        $products->where('stock', '<=', 0);
                    }
                }

        // Free shipping filter
        if ($request->boolean('free_shipping')) {
            $products->where(function ($q) {
                $q->where('free_shipping', 1)->orWhere('free_shipping_enabled', 1);
            });
        }
        
        if(!empty($request->query('category'))){
            $slug=explode(',',$request->query('category'));
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($request->query('brand'))){
            $slugs=explode(',',$request->query('brand'));
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($request->query('sortBy'))){
            if($request->query('sortBy')=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($request->query('sortBy')=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($request->query('price'))){
            $price=explode('-',$request->query('price'));
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($request->query('show'))){
            $products=$products->where('status','active')->paginate($request->query('show'));
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists(Request $request){
        $products=Product::query();
                // Availability filter
                if(!empty($request->query('availability'))){
                    $availability = (array) $request->query('availability');
                    if(in_array('in_stock', $availability) && !in_array('out_of_stock', $availability)){
                        $products->where('stock', '>', 0);
                    } elseif(!in_array('in_stock', $availability) && in_array('out_of_stock', $availability)){
                        $products->where('stock', '<=', 0);
                    }
                }

        // Free shipping filter
        if ($request->boolean('free_shipping')) {
            $products->where(function ($q) {
                $q->where('free_shipping', 1)->orWhere('free_shipping_enabled', 1);
            });
        }
        
        if(!empty($request->query('category'))){
            $slug=explode(',',$request->query('category'));
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($request->query('brand'))){
            $slugs=explode(',',$request->query('brand'));
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($request->query('sortBy'))){
            if($request->query('sortBy')=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($request->query('sortBy')=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($request->query('price'))){
            $price=explode('-',$request->query('price'));
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($request->query('show'))){
            $products=$products->where('status','active')->paginate($request->query('show'));
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $query = [];
            if (!empty($data['show'])) {
                $query['show'] = $data['show'];
            }
            if (!empty($data['sortBy'])) {
                $query['sortBy'] = $data['sortBy'];
            }
            if (!empty($data['category']) && is_array($data['category'])) {
                $query['category'] = implode(',', $data['category']);
            }
            if (!empty($data['brand']) && is_array($data['brand'])) {
                $query['brand'] = implode(',', $data['brand']);
            }
            if (!empty($data['availability']) && is_array($data['availability'])) {
                $query['availability'] = $data['availability'];
            }
            if (!empty($data['price_range'])) {
                $query['price'] = $data['price_range'];
            }
            if (!empty($data['free_shipping'])) {
                $query['free_shipping'] = 1;
            }

            $targetView = $data['view'] ?? null;
            if (empty($targetView)) {
                $previous = url()->previous();
                if (Str::contains($previous, 'product-grids')) {
                    $targetView = 'grid';
                } elseif (Str::contains($previous, 'product-lists')) {
                    $targetView = 'list';
                }
            }

            $targetRoute = ($targetView === 'list') ? 'product-lists' : 'product-grids';
            return redirect()->route($targetRoute, $query);
    }
    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $search = trim((string) $request->input('search', ''));
        if ($search === '') {
            return redirect()->back();
        }

        $products = Product::query()
                    ->where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('title','like','%'.$search.'%')
                            ->orWhere('slug','like','%'.$search.'%')
                            ->orWhere('description','like','%'.$search.'%')
                            ->orWhere('summary','like','%'.$search.'%')
                            ->orWhere('price','like','%'.$search.'%');
                    })
                    ->orderBy('id','DESC')
                    ->paginate(9)
                    ->appends(['search' => $search]);
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog(){
        $post=Post::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $loginInput = trim($validated['login']);
        $password = $validated['password'];
        $remember = (bool) $request->input('news');

        $query = User::query()->where('status', 'active');

        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $query->where('email', $loginInput);
        } else {
            $digits = preg_replace('/\D+/', '', $loginInput);

            $query->where(function ($q) use ($loginInput, $digits) {
                $q->where('phone', $loginInput);

                if ($digits !== '') {
                    $q->orWhereRaw(
                        "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone,' ',''),'-',''),'(',''),')',''),'+','') = ?",
                        [$digits]
                    );
                }
            });
        }

        $user = $query->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            request()->session()->flash('success', 'Successfully login');
            return redirect()->route('home');
        }

        request()->session()->flash('error', 'Invalid email/phone or password. Please try again!');
        return redirect()->back()->withInput($request->only('login'));
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        request()->session()->flash('success','Logout successfully');
        return redirect()->route('login.form');
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'first_name'=>'string|required|min:2|max:100',
            'last_name'=>'string|required|min:1|max:100',
            'email'=>'string|required|unique:users,email',
            'phone'=>'string|required|max:50|regex:/^\+?[0-9\s\-()]+$/',
            'address1'=>'string|required|max:255',
            'address2'=>'string|nullable|max:255',
            'address3'=>'string|nullable|max:255',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        $fullName = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        return User::create([
            'name'=>$fullName,
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'address1'=>$data['address1'],
            'address2'=>$data['address2'] ?? null,
            'address3'=>$data['address3'] ?? null,
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
