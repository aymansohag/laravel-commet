<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Post::latest() -> get();
        $all_cat = Category::latest() -> get();
        return view('admin.post.index', compact('all_data', 'all_cat'));
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
            'title'  => 'required',
            'content'  => 'required',
        ],[
            'title.required'  => 'The title field is required',
            'content.required'  => 'The content field is required',
        ]);

        if($request -> hasFile('fimage')){
            $image = $request -> file('fimage');
            $image_name = md5(time().rand()).'.'. $image -> getClientOriginalExtension();
            $image -> move(public_path('media/posts'), $image_name);
        }else{
            $image_name = '';
        }

       $post_user =  Post::create([
            'title'  => $request -> title,
            'slug'  => Str::slug($request -> title),
            'user_id'  => Auth::user() -> id,
            'content'  => $request -> content,
            'featured_image'  => $image_name,
        ]);

        $post_user -> categories() -> attach($request -> category);

        return redirect() -> route('post.index') -> with('success', 'Post Uploaded Successfull !');
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
       $data = Post::find($id);
       $cat_all = Category::latest() -> get();
       $post_cat = $data -> categories;
       $check_id = [];
       foreach($post_cat as $check_cat){
            array_push($check_id, $check_cat -> id);
       }
       $cat_list = '';
       foreach($cat_all as $cat){
           if(in_array( $cat -> id, $check_id)){
                $checked = 'checked';
           }else{
               $checked = "";
           }
            $cat_list .= '<div class="checkbox">
                                <label>
                                    <input '.$checked.' type="checkbox" value="'.$cat -> id.'"name="category[]"> '.$cat -> name.'
                                </label>
                          </div>';
       }
       return [
            'title'    => $data -> title,
            'image'    => $data -> featured_image,
            'cat_list' => $cat_list,
            'content'  => $data -> content,
            'id'       => $data -> id,
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
        $data = Post::find($id);

        $this -> validate($request, [
            'title'  => 'required',
            'content'  => 'required',
        ],[
            'title.required'  => 'The title field is required',
            'content.required'  => 'The content field is required',
        ]);

        if($request -> hasFile('fimage_update')){
            $image = $request -> file('fimage_update');
            $image_name = md5(time().rand()).'.'. $image -> getClientOriginalExtension();
            $image -> move(public_path('media/posts'), $image_name);
        }else{
            $image_name = '';
        }

        $data -> title = $request -> title;
        $data -> slug = Str::slug($request -> title);
        $data -> user_id = Auth::user() -> id;
        $data -> content = $request -> content;
        $data -> categories() -> detach();
        $data -> categories() -> attach($request -> category);
        $data -> featured_image = $image_name;

        $data -> update();

        return redirect() -> route('post.index') -> with('success', 'Post Updated Successfull');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_delete = Post::find($id);
        $post_delete -> delete();
        return redirect() -> route('post.index') -> with('success', 'Post Deleted Successfull');
    }
    /**
     * Post Unpublished / Published
     */
    public function postUnpublished($id){
        $data = Post::find($id);
        $data -> status = 'Unpublished';
        $data -> update();
        return redirect() -> route('post.index') -> with('success', 'Post was  Unpublished !');
    }
    public function postPublished($id){
        $data = Post::find($id);
        $data -> status = 'Published';
        $data -> update();
        return redirect() -> route('post.index') -> with('success', 'Post was  Published !');
    }
}
