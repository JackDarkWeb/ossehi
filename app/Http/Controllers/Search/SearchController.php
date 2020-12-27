<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryContract;


class SearchController extends Controller
{

    protected PostRepositoryContract $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    function searchPosts(){

        $posts = $this->postRepository->searchPosts(request()->q);

        $recent_posts = $this->postRepository->recentPosts(2);

        $archive_posts = $this->postRepository->archivePosts(3);

        return view('search.search-post',[
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'archive_posts' => $archive_posts
        ]);
    }
}
