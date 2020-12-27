<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Contracts\PostRepositoryContract;

class CategoryController extends Controller
{
    protected PostRepositoryContract $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    public  function posts($lang, $slug){

        $category = Category::where('name', $slug)->first();

        if (!$category){
            return back();
        }

        $recent_posts = $this->postRepository->recentPosts(2);

        $archive_posts = $this->postRepository->archivePosts(3);

        $posts = $this->postRepository->PostsByCategory($slug);


        return view('post.blog',[
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'archive_posts' => $archive_posts
        ]);
    }

    public  function products($lang, $slug){

    }
}
