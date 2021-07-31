<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class FrontEndController extends Controller
{
    /**
     * FrontEnd Home page
     *
     * @return void
     */

    public function homePage(){
        return view('frontend.home');
    }

    /**
     * FrontEnd Blog Page
     *
     * @return void
     */

    public function blogPage(){
        $all_post = Post::latest() -> paginate(5);
        return view('frontend.blog', compact('all_post'));
    }

    /**
     * FrontEnd Blog Single page
     *
     * @return void
     */

    public function blogSingle($slug){
        $singlge_post = Post::where('slug', $slug) -> first();
        return view('frontend.single',[
            'post'   => $singlge_post,
        ]);
    }

    /**
     *  Post Search by category
     */

     public function searchPostByCategory($slug){
        $cats = Category::where('slug', $slug) -> get() -> first();
        return view('frontend.category-search', compact('cats'));
     }

     /**
      * Post by search form
      */
    public function postBySearch(Request $request){
        $search_text = $request -> search;
        $post = Post::where('title', 'like', '%'.$search_text.'%') -> orWhere('content', 'like', '%'.$search_text.'%') -> get();

        return view('frontend.search', compact('post'));
    }
}
