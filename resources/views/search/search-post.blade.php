@extends('layouts.default', ['title' => __('Search the posts')])


@section('content')


    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Results') }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">

                    <div class="col-lg-9">

                        <p>{{ __("Around :results result(s)", ['results' => $posts->total()]) }}</p>

                        @foreach($posts as $post)

                            <article class="entry">

                                <div class="entry-body">

                                    <div class="entry-date">
                                        <span class="day">{{ $post->day_post }}</span>
                                        <span class="month">{{ __( $post->month_post ) }}</span>
                                    </div><!-- End .entry-date -->

                                    <h2 class="entry-title">
                                        <a href="{{ route_name('posts.single', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h2>

                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        @endforeach

                        <nav class="toolbox toolbox-pagination">
                            <ul class="pagination">

                                {{ $posts->withQueryString()->links()  }}

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
