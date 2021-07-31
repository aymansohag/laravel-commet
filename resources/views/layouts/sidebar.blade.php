			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
								<span>Main</span>
							</li>
							<li class="active">
								<a href="{{ route('home') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Posts </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('post.index') }}"> All Post </a></li>
									<li><a href="{{ route('post-category.index') }}"> Category </a></li>
									<li><a href="{{ route('post-tag.index') }}"> Tags </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('logo.index') }}"> Logo </a></li>
									<li><a href="{{ route('social.index') }}"> Social Icon </a></li>
									<li><a href=""> Footer Copyright </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="fe fe-layout"></i> <span> Home Page </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('slider.index') }}"> Slider </a></li>
									<li><a href=""> Who We Are </a></li>
									<li><a href=""> Expertise </a></li>
									<li><a href=""> The Vision </a></li>
									<li><a href=""> Our Clients </a></li>
									<li><a href=""> Testimonial </a></li>
									<li><a href=""> Home Setup </a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
