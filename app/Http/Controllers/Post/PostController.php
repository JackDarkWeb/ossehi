<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryContract;


class PostController extends Controller
{
    protected PostRepositoryContract $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function allPosts()
    {

        //dd(menu_category_blog());
        $posts = $this->postRepository->getAll();

        $recent_posts = $this->postRepository->recentPosts(2);

        $archive_posts = $this->postRepository->archivePosts(3);

        return view('post.blog',[
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'archive_posts' => $archive_posts
        ]);
    }

    public function single($lang, $slug){

        $post = $this->postRepository->findBySlug($slug);

        if (!$post){
            return back();
        }

        if (!$post->categories()->first()){
            return back();
        }

        $related_posts = $this->postRepository->relatedPosts($post->categories()->first()->name, $slug, 6);

        $comments = $this->postRepository->getCommentsByPost($post);


        $recent_posts = $this->postRepository->recentPosts(2);

        $archive_posts = $this->postRepository->archivePosts(3);

        return view('post.single',[
            'post' => $post,
            'comments' => $comments,
            'recent_posts' => $recent_posts,
            'archive_posts' => $archive_posts,
            'related_posts' => $related_posts
        ]);
    }
}
