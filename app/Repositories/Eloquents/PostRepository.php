<?php


namespace App\Repositories\Eloquents;

use App\Helpers\Auth;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository implements PostRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll(){

        return $this->format()
                    ->paginate(3);
    }

    /**
     * @param $slug
     * @return Builder|Model|mixed|object|null
     */
    public function findBySlug($slug)
    {
        return Post::with(['categories', 'comments'])
            ->where('slug', $slug)
            ->where('published', 1)
            ->where('archive',0)
            ->first();

    }

    /**
     * @param $take_number_of_post
     * @return Builder[]|Collection|mixed
     */
    function recentPosts($take_number_of_post){

        return $this->format()
                    ->take($take_number_of_post)
                    ->get();
    }

    /**
     * @return Builder
     */
    protected function format(){

        return Post::with('categories')
            ->where('published', 1)
            ->where('archive',0)
            ->latest();
    }

    /**
     * @param $take_number_of_post
     * @return Builder[]|Collection
     */
    public function archivePosts($take_number_of_post)
    {
        return Post::with('categories')
            ->where('published', 1)
            ->where('archive',1)
            ->latest()
            ->take($take_number_of_post)
            ->get();
    }

    /**
     * @param $name_category
     * @return mixed
     */
    public function PostsByCategory($name_category)
    {
        return $this->formatByCategory($name_category)
                    ->paginate(3);
    }

    /**
     * @param $name_category
     * @param $slug
     * @param $take_number_of_post
     * @return mixed
     */
    public function relatedPosts($name_category, $slug, $take_number_of_post)
    {
        return $this->formatByCategory($name_category)
                    ->where('slug', '!=', $slug)
                    ->take($take_number_of_post)
                    ->get();
    }

    /**
     * @param $name_category
     * @return mixed
     */
    protected function formatByCategory($name_category){

        return Post::whereHas('categories', function (Builder $query) use ($name_category){

            $query->where('name', $name_category);

        })->where('published', 1)
            ->where('archive',0)
            ->latest();
    }

    public function findById($id)
    {
        return Post::with(['categories', 'comments'])
            ->where('id', $id)
            ->where('published', 1)
            ->where('archive',0)
            ->first();
    }

    /**
     * @param Post $post
     * @return Collection|\Illuminate\Support\Collection|mixed
     */
    public function getCommentsByPost(Post $post)
    {
        return $post->comments()->with('user')
            ->latest()
            ->get()
            ->map(function ($comment){
                return (object)[
                    'body' => $comment->body,
                    'user_id' => $comment->user_id,
                    'user_name_profile' => $comment->user->user_name_profile,
                    'user_name' => $comment->user->user_name,
                    'date' => $comment->date_comment
                ];
            });
    }

    /**
     * @param Post $post
     * @param $request
     * @return mixed|void
     */
    public function createCommentOnThisPost(Post $post, $request)
    {
        return $post->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->get('body')
        ]);
    }

    public function searchPosts($q)
    {
       return $this->format()->where(function (Builder $query) use ($q){

           $query->where('title', 'like', "%$q%")
                 ->orWhere('content', 'like', "%$q%");

       })->paginate(7);
    }
}
