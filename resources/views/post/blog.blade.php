@extends('layouts.default', ['title' => 'blog'])


@section('content')


    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Blog') }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">

                        @foreach($posts as $post)

                            <article class="entry">
                            <div class="entry-media">
                                <a href="{{ route_name('posts.single', ['slug' => $post->slug]) }}">
                                    <img src="{{ asset($post->image) }}" alt="Post">
                                </a>
                            </div><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-date">
                                    <span class="day">{{ $post->day_post }}</span>
                                    <span class="month">{{ __( $post->month_post ) }}</span>
                                </div><!-- End .entry-date -->

                                <h2 class="entry-title">
                                    <a href="{{ route_name('posts.single', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h2>

                                <div class="entry-content">
                                    <p>{{$post->short_content}}</p>

                                    <a href="{{ route_name('posts.single', ['slug' => $post->slug]) }}" class="read-more">{{__('Read More')}} <i class="icon-angle-double-right"></i></a>
                                </div><!-- End .entry-content -->

                                <div class="entry-meta">
                                    <span><i class="icon-calendar"></i>{{ $post->date_post }}</span>
                                    <span><i class="icon-user"></i>{{ __('By') }} <a href="#">{{ $post->author_post }}</a></span>
                                    <span><i class="icon-folder-open"></i>

                                        @foreach($post->categories as $category)

                                            <a class="comma_separator-item active" href="{{ route_name('posts.category', ['slug' => $category->name]) }}">{{ __($category->name) }}</a>

                                        @endforeach

                                    </span>
                                </div><!-- End .entry-meta -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                        @endforeach

                        <nav class="toolbox toolbox-pagination">
                            <ul class="pagination">
                                {{ $posts->links()  }}
                            </ul>
                        </nav>

                    </div><!-- End .col-lg-9 -->


                    @include('layouts.sidebar_blog')

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        </main><!-- End .main -->

       @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')
@stop
