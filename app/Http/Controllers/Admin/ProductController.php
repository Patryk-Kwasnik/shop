<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\ProductRequest;
use DB;

class ProductController extends Controller
{
    protected $productRepository; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(ProductRepository $productRepository)
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->productRepository = $productRepository; 
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getAll();
    
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        $categories = $this->categoryRepository->getParentCategories();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->categoryRepository->create($request->validated());
        return redirect()->route('admin.products.index')
            ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Role::find($id);
        $productPermissions = Permission::join("product_has_permissions","product_has_permissions.permission_id","=","permissions.id")
            ->where("product_has_permissions.product_id",$id)
            ->get();

        return view('admin.products.show', compact('product','productPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Role::find($id);
        $permission = Permission::get();

        $productPermissions = DB::table("product_has_permissions")->where("product_has_permissions.product_id",$id)
            ->pluck('product_has_permissions.permission_id','product_has_permissions.permission_id')
            ->all();

        return view('admin.products.edit', compact('product','permission','productPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $product = Role::find($id);
        $product->name = $request->input('name');
        $product->save();

        $product->syncPermissions($request->input('permission'));

        return redirect()->route('admin.products.index')->with('success',__('system.success_update_mes'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("products")->where('id',$id)->delete();
        return redirect()->route('admin.products.index')->with($notification);
    }
}
