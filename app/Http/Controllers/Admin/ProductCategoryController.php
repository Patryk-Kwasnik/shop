<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Repositories\ProductCategoryRepository;
use DB;

class ProductCategoryController extends Controller
{
    protected $categoryRepository;

    function __construct(ProductCategoryRepository $categoryRepository)
    {
        $this->middleware('permission:products-categories-list|products-categories-create|products-categories-edit|products-categories-delete', ['only' => ['index','show']]);
        $this->middleware('permission:products-categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:products-categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:products-categories-delete', ['only' => ['destroy']]);
        $this->categoryRepository = $categoryRepository; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->categoryRepository->getAll();

        return view('admin.products_categories.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products_categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        NewsCategory::create($request->all());
        return redirect()->route('newsCategory.index')
            ->with('success',__('system.success_save_mess'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
            'name' => 'required'
        ]);
        $category = NewsCategory::find($id);
        $category->update($request->all());
        return redirect()->route('newsCategory.index')->with('success',__('system.success_update_mes'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("news_categories")->where('id',$id)->delete();
        $notification = array(
            'message' => __('system.success_del_mess'),
            'alert-type' => 'info'
        );
        return redirect()->route('newsCategory.index')->with($notification);
    }
}