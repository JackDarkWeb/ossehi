<?php


namespace App\Repositories\Contracts;


use App\Models\Post;

interface PostRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);


    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $take_number_of_post
     * @return mixed
     */
    public function recentPosts($take_number_of_post);

    /**
     * @param $take_number_of_post
     * @return mixed
     */
    public function archivePosts($take_number_of_post);

    /**
     * @param $name_category
     * @return mixed
     */
    public function PostsByCategory($name_category);

    /**
     * @param $name_category
     * @param $slug
     * @param $take_number_of_post
     * @return mixed
     */
    public function relatedPosts($name_category, $slug, $take_number_of_post);

    /**
     * @param Post $post
     * @return mixed
     */
    public function getCommentsByPost(Post $post);

    /**
     * @param Post $post
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisPost(Post $post, $request);

    /**
     * @param $q
     * @return mixed
     */
    public function searchPosts($q);



}
