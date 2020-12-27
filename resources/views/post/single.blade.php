@extends('layouts.default', ['title' => $post->title])


@section('content')



    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route_name('home')}}"><i class="icon-home"></i></a></li>

                        @foreach($post->categories as $category)
                            <li class="breadcrumb-item active" aria-current="page">{{ __($category->name) }}</li>
                        @endforeach

                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <article class="entry single">
                            <div class="entry-media">
                                <div class="entry-slider owl-carousel owl-theme owl-theme-light">
                                    <img src="{{ asset($post->image) }}" alt="Post">
                                    <img src="{{ asset($post->image) }}" alt="Post">
                                </div><!-- End .entry-slider -->
                            </div><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-date">
                                    <span class="day">{{ $post->day_post }}</span>
                                    <span class="month">{{ $post->month_post }}</span>
                                </div><!-- End .entry-date -->

                                <h2 class="entry-title">
                                    {{ $post->title }}
                                </h2>

                                <div class="entry-meta">
                                    <span><i class="icon-calendar"></i>{{ $post->date_post }}</span>
                                    <span><i class="icon-user"></i>{{ __('By') }} <a href="#">{{$post->author_post}}</a></span>
                                    <span><i class="icon-folder-open"></i>

                                        @foreach($post->categories as $category)

                                            <a class="comma_separator-item active" href="{{ route_name('posts.category', ['slug' => $category->name]) }}">{{ __($category->name) }}</a>

                                        @endforeach
                                    </span>
                                </div><!-- End .entry-meta -->

                                <div class="entry-content">
                                    {{$post->content}}
                                </div><!-- End .entry-content -->

                                <div class="entry-share">
                                    <h3>
                                        <i class="icon-forward"></i>
                                        {{__('Share this post')}}
                                    </h3>

                                    <div class="social-icons">
                                        <a href="#" class="social-icon social-facebook" target="_blank" title="Facebook">
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon social-linkedin" target="_blank" title="Linkedin">
                                            <i class="icon-linkedin"></i>
                                        </a>
                                        <a href="#" class="social-icon social-gplus" target="_blank" title="Google +">
                                            <i class="icon-gplus"></i>
                                        </a>
                                        <a href="#" class="social-icon social-mail" target="_blank" title="Email">
                                            <i class="icon-mail-alt"></i>
                                        </a>
                                    </div><!-- End .social-icons -->
                                </div><!-- End .entry-share -->

                                <div class="entry-author">
                                    <h3><i class="icon-user"></i>{{__('Author')}}</h3>

                                    <figure>
                                        <a href="#">
                                            <img src="{{asset('images/admins/admin-1.jpg')}}" alt="author">
                                        </a>
                                    </figure>

                                    <div class="author-content">
                                        <h4><a href="#">{{ $post->author_post }}</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab officia culpa corporis, quidem placeat minima unde vel veniam laboriosam et animi, inventore delectus, officiis doloribus ex amet illum ea suscipit!</p>
                                    </div><!-- End .author.content -->
                                </div><!-- End .entry-author -->

                                <div class="comment-respond shoutbox">

                                    <h3>{{__('Leave a Reply')}}</h3>

                                    <h1>{{__('Comments')}} <img src="{{asset('images/refresh.png')}}"/></h1>

                                    <ul class="shoutbox-content">

                                        @foreach($comments as $comment)
                                            <li>
                                                <p id="p"><img src="https://eu.ui-avatars.com/api/?name={{ $comment->user_name_profile }}" style="width: 40px; height: 40px; border-radius: 50%" id="img-comment">
                                                    <span class="shoutbox-username">{{ $comment->user_name }}</span></p>
                                                <p class="shoutbox-comment">{{ $comment->body }}</p>
                                                <div class="shoutbox-comment-details">

                                                    @if(Auth::id() !== $comment->user_id)

                                                      <span class="shoutbox-comment-reply" id="shoutbox-comment-reply" data-name="{{ $comment->user_name }}">REPLY</span>

                                                    @endif
                                                    <span class="shoutbox-comment-ago">{{ $comment->date }}</span>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>

                                    <div class="shoutbox-form">

                                        <h2>{{__('Write a message')}} <span>×</span></h2>

                                        <form action="" method="post" id="comment-form">

                                            @csrf

                                            <input type="hidden"  value="{{$post->id}}" id="post-id"/>

                                            <div class="form-group required-field">
                                                <textarea name="comment" cols="30" rows="1" class="form-control" id="comment"></textarea>
                                            </div><!-- End .form-group -->
                                            <div class="form-footer">
                                                <button type="submit" id="submit" class="{{ Auth::is() ? 'btn btn-primary' : 'btn btn-primary login-link' }}">{{__('Post Comment')}}</button>
                                            </div><!-- End .form-footer -->
                                        </form>
                                    </div>


                                    {{--
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                    <form action="#">
                                        <div class="form-group required-field">
                                            <label>Comment</label>
                                            <textarea cols="30" rows="1" class="form-control" required></textarea>
                                        </div><!-- End .form-group -->

                                        <div class="form-group required-field">
                                            <label>Name</label>
                                            <input type="text" class="form-control" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group required-field">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="url" class="form-control">
                                        </div><!-- End .form-group -->

                                        <div class="form-group-custom-control mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="save-name">
                                                <label class="custom-control-label" for="save-name">Save my name, email, and website in this browser for the next time I comment.</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group-custom-control -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">Post Comment</button>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    --}}
                                </div><!-- End .comment-respond -->

                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->

                        <div class="related-posts">
                            <h4 class="light-title">{{__('Related')}} <strong>{{__('Posts')}}</strong></h4>


                            <div class="owl-carousel owl-theme related-posts-carousel">

                                @foreach($related_posts as $related_post)

                                    <article class="entry">

                                        <div class="entry-media">
                                            <a href="{{ route_name('posts.single', ['slug' => $related_post->slug]) }}">
                                                <img src="{{ asset($related_post->image) }}" alt="Post">
                                            </a>
                                        </div><!-- End .entry-media -->

                                        <div class="entry-body">
                                            <div class="entry-date">
                                                <span class="day">{{ $related_post->day_post}}</span>
                                                <span class="month">{{ $related_post->month_post}}</span>
                                            </div><!-- End .entry-date -->

                                            <h2 class="entry-title">
                                                <a href="{{ route_name('posts.single', ['slug' => $related_post->slug]) }}">{{ $related_post->short_title }}</a>
                                            </h2>

                                            <div class="entry-content">
                                                <p>{{ $related_post->short_content }}</p>

                                                <a href="{{ route_name('posts.single', ['slug' => $related_post->slug]) }}" class="read-more">{{__('Read More')}} <i class="icon-angle-double-right"></i></a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->

                                    </article>

                                @endforeach

                            </div><!-- End .owl-carousel -->
                        </div><!-- End .related-posts -->
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

@section('scripts')

    <script type="module">

        import Validator from "{{ asset("js/Validator.js") }}";
        import Helpers from "{{ asset("js/Helpers.js") }}";
        import Comment from "{{ asset("js/Comment.js") }}";

        $(function () {


            let canPostComment = true,
                request = new Object();

            const $doc = $(document);

            // Automatically refresh the shouts every 20 seconds
            setInterval(fetchLatestComments, 20000);


            $doc.on('submit', '#comment-form', function (event) {
                event.preventDefault();

                if(!canPostComment) return;

                if (Validator.getValue(this, '#comment')){

                    // Prevent new comment from being published
                    canPostComment = false;

                    request.body = Validator.getValue(this, '#comment');
                    request.commentable_id = Validator.getValue(this, '#post-id');

                    Validator.requestAjax('POST', "{{ route_name('comments.store') }}", func_callback, request);

                    // Allow a new comment to be posted after 5 seconds
                    setTimeout(function(){
                        canPostComment = true;
                    }, 5000);
                }

            });

            function func_callback(response) {

                if (response.success){

                    Helpers.setValue('#comment-form', '#comment', ' ');

                    fetchLatestComments();
                }
            }





            // Toggle the visibility of the form.

            $doc.on('click', '.shoutbox h2', function(event){
                event.preventDefault();

                if($('#comment-form').is(':visible')) {
                    Comment.closeForm('#comment-form', '.shoutbox h2 span');
                } else {
                    Comment.openForm('#comment-form', '.shoutbox h2 span');
                }
            });


            // Clicking on the REPLY button writes the name of the person you want to reply to into the text comment.

            Comment.replyComment('#comment-form', '#shoutbox-comment-reply', '#comment', '.shoutbox h2 span');

            Helpers.submitWithEnter('#comment-form', '#comment');

            // Clicking the refresh button will force the load function
            Comment.reloadComments('.shoutbox h1 img', true, fetchLatestComments);



            // Fetch the latest comments

            function fetchLatestComments() {

                Validator.requestAjax('GET', "{{ route('comments.fetch', ['lang' => app()->getLocale(), 'post_id' => $post->id]) }}", func_fetch_callback);
            }

            function func_fetch_callback(response) {

                if (response.success){
                    renderComments(response);
                }
            }

            // Render an array of shouts as HTML

            function renderComments(response) {

                $('.shoutbox-content').empty();

                response.comments.forEach(function(d){

                    $('.shoutbox-content').append(`
                       <li>
                            <p id="p"><img src="https://eu.ui-avatars.com/api/?name=${d.user_name_profile}" style="width: 40px; height: 40px; border-radius: 50%" id="img-comment">
                            <span class="shoutbox-username"> ${d.user_name} </span></p>
                            <p class="shoutbox-comment"> ${d.body} </p>

                             ${ "{{ Auth::id() }}" == d.user_id ? '' : `<div class="shoutbox-comment-details"><span class="shoutbox-comment-reply" data-name="${d.user_name}">REPLY</span>` }

                           <span class="shoutbox-comment-ago"> ${d.date} </span></div>
                       </li>
                    `);
                });

            }

        })

    </script>
@endsection
