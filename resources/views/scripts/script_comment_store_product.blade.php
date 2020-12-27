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

                Validator.requestAjax('POST', "{{ route_name('comments.store_product') }}", func_callback, request);

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

            Validator.requestAjax('GET', "{{ route('comments.store_product.fetch', ['lang' => app()->getLocale(), 'store_product_id' => $product->id]) }}", func_fetch_callback);
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
