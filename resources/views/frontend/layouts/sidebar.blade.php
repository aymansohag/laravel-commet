<div class="col-md-3 col-md-offset-1">
    <div class="sidebar hidden-sm hidden-xs">
      <div class="widget">
        <h6 class="upper">Search blog</h6>
        <form action="{{ route('post.search') }}" method="post">
            @csrf
          <input name="search" type="text" placeholder="Search.." class="form-control">
        </form>
      </div>
      <!-- end of widget        -->
      <div class="widget">
        <h6 class="upper">Categories</h6>
        <ul class="nav">

            {{-- Categories Show from categories table --}}

            @php
                $all_cat = App\models\Category::latest() -> take(7) -> get();
            @endphp
            @foreach ($all_cat as $cat)
                <li>
                    <a href="{{ route('blog-category.slug', $cat -> slug) }}">{{ $cat -> name }}</a>
                </li>
            @endforeach

        </ul>
      </div>
      <!-- end of widget        -->
      <div class="widget">
        <h6 class="upper">Popular Tags</h6>
        <div class="tags clearfix">
            @php
                $all_tag = App\models\Tag::latest() -> take(7) -> get();
            @endphp
            @foreach ($all_tag as $tag)
                <a href="#">{{ $tag -> name }}</a>
            @endforeach
        </div>
      </div>
      <!-- end of widget      -->
      <div class="widget">
        <h6 class="upper">Latest Posts</h6>
        <ul class="nav">
            {{-- Post show from Post table --}}
            @php
                $all_post = App\models\Post::latest() -> take(5) -> get();
            @endphp
            @foreach ($all_post as $post)
                 <li>
                     <a href="#">
                         {{ $post -> title }}
                         <i class="ti-arrow-right"></i>
                         <span>{{ date('F d, Y', strtotime($post -> created_at)) }}</span>
                     </a>
                </li>
            @endforeach
        </ul>
      </div>
      <!-- end of widget          -->
    </div>
    <!-- end of sidebar-->
  </div>
