<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Tag::latest() -> get();
        return view('admin.post.tags.index', compact('all_data'));
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
        $this -> validate($request, [
            'name'   => 'required | unique:tags'
        ],[
            'name.required'  => 'The tag field must not be empty !',
            'name.unique'  => 'The tag name is already exist !',
        ]);

        Tag::create([
            'name' => $request -> name,
            'slug' => Str::slug($request -> name),
        ]);

        return redirect() -> route('post-tag.index') -> with('success', 'Tag Added Successfull !');
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
        $data = Tag::find($id);
        return [
            'name'  => $data -> name,
            'id'  => $data -> id,
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
        $data = Tag::find($id);

        $data -> name = $request -> name;
        $data -> slug = Str::slug($request -> name);
        $data -> update();
        return redirect() -> route('post-tag.index') -> with('success', 'Tag Updated Successfull !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_tag = Tag::find($id);
        $delete_tag -> delete();
        return redirect() -> route('post-tag.index') -> with('success', 'Tag Deleted Successfull !');
    }
    /**
     * Published un published
     */
    public function tagUnpublished($id){
        $data = Tag::find($id);
        $data -> status = 'Unpublished';
        $data -> update();

        return redirect() -> route('post-tag.index') -> with('success', 'Tag was Unpublished');
    }
    public function tagPublished($id){
        $data = Tag::find($id);
        $data -> status = 'Published';
        $data -> update();

        return redirect() -> route('post-tag.index') -> with('success', 'Tag was Publishde');
    }
}
