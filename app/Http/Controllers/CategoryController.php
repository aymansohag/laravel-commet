<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_cat = Category::latest() -> get();
        return view('admin.post.categorys.index', [
            'all_cat'    => $all_cat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            'name'     => 'required',
        ],[
            'name.required'   => 'Category field must not be empty !',
        ]);

        Category::create([
            'name'    => $request -> name,
            'slug'    => Str::slug($request -> name),
        ]);

        return redirect() -> route('post-category.index') -> with('success', 'Category Added Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat_data = Category::find($id);
        return [
            'name' => $cat_data -> name,
            'id'   => $cat_data -> id,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request -> id;
        $update_data = Category::find($id);

        $update_data -> name = $request -> name;
        $update_data -> slug = Str::slug($request -> name);
        $update_data -> update();

        return redirect() -> route('post-category.index') -> with('success', 'Category Updated Successfull');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat_delete = Category::find($id);
        $cat_delete -> delete();
        return redirect() -> route('post-category.index') -> with('success', 'Category Deleted Successfull');
    }

    /**
     * Unpublished / Published category
     */

     public function unpublishedCategory($id){
        $cat_update = Category::find($id);
        $cat_update -> status = "Unpublished";
        $cat_update -> update();

        return redirect() -> route('post-category.index') -> with('success', 'Category was unpublished');
     }
     public function publishedCategory($id){
        $cat_update = Category::find($id);
        $cat_update -> status = "Published";
        $cat_update -> update();

        return redirect() -> route('post-category.index') -> with('success', 'Category was published');
     }
}
