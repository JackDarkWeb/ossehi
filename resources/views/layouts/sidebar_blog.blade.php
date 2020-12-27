<aside class="sidebar col-lg-3">
    <div class="sidebar-wrapper">
        <div class="widget widget-search">
            <form role="search" method="get" class="search-form" action="{{ route_name('search.post') }}">
                <input type="search" class="form-control" placeholder="{{ __('Search posts here') }}..."  onkeyup="return this.value = this.value.toLowerCase()" name="q" required>
                <button type="submit" class="search-submit" title="Search">
                    <i class="icon-search"></i>
                    <span class="sr-only">{{ __('Search') }}</span>
                </button>
            </form>
        </div><!-- End .widget -->

        <div class="widget widget-categories">
            <h4 class="widget-title">{{ __('Blog Categories') }}</h4>

            <ul class="list">

                @foreach(menu_category_blog() as $category)

                    <li><a href="{{ route_name('posts.category', ['slug' => $category->category_name]) }}">{{ __( $category->category_name ) }}</a></li>

                @endforeach

            </ul>
        </div><!-- End .widget -->

        <div class="widget">
            <h4 class="widget-title">{{__('Recent Posts')}}</h4>

            <ul class="simple-entry-list">

                @foreach($recent_posts as $recent_post)
                    <li>
                        <div class="entry-media">
                            <a href="{{ route_name('posts.single', ['slug' => $recent_post->slug]) }}">
                                <img src="{{ asset( $recent_post->image ) }}" alt="Post">
                            </a>
                        </div><!-- End .entry-media -->
                        <div class="entry-info">
                            <a href="{{ route_name('posts.single', ['slug' => $recent_post->slug]) }}">{{$recent_post->short_title}}</a>
                            <div class="entry-meta">
                                {{ $recent_post->data_post }}
                            </div><!-- End .entry-meta -->
                        </div><!-- End .entry-info -->
                    </li>
                @endforeach

            </ul>
        </div><!-- End .widget -->

        <div class="widget">
            <h4 class="widget-title">Tagcloud</h4>

            <div class="tagcloud">
                <a href="#">Fashion</a>
                <a href="#">Shoes</a>
                <a href="#">Skirts</a>
                <a href="#">Dresses</a>
                <a href="#">Bags</a>
            </div><!-- End .tagcloud -->
        </div><!-- End .widget -->

        <div class="widget">
            <h4 class="widget-title">{{ __('Archive') }}</h4>

            <ul class="list">

                @foreach($archive_posts as $archive_post)
                    <li><a href="{{ route_name('posts.single', ['slug' => $archive_post->slug]) }}">{{ $archive_post->short_date_post }}</a></li>
                @endforeach

            </ul>

        </div><!-- End .widget -->


        <div class="widget widget_compare">
            <h4 class="widget-title">{{ __('Compare Products') }}</h4>

            <p>{{ __('You have no items to compare.') }}</p>
        </div><!-- End .widget -->
    </div><!-- End .sidebar-wrapper -->
</aside><!-- End .col-lg-3 -->
