
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

            @if(isset($product))
                <input type="hidden"  value="{{$product->id}}" id="post-id"/>
            @elseif(isset($various))
                <input type="hidden"  value="{{$various->id}}" id="post-id"/>
            @endif

            <div class="form-group required-field">
                <textarea name="comment" cols="30" rows="1" class="form-control" id="comment"></textarea>
            </div><!-- End .form-group -->
            <div class="form-footer">
                <button type="submit" id="submit" class="{{ Auth::is() ? 'btn btn-primary' : 'btn btn-primary login-link' }}">{{__('Post Comment')}}</button>
            </div><!-- End .form-footer -->
        </form>
    </div>

</div><!-- End .comment-respond -->
