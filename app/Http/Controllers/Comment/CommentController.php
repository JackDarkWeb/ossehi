<?php

namespace App\Http\Controllers\Comment;


use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\StoreProductRepositoryContract;
use App\Repositories\Contracts\VariousRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected PostRepositoryContract $postRepository;
    protected  VariousRepositoryContract $variousRepository;
    protected StoreProductRepositoryContract $storeProductRepository;
    protected ProductRepositoryContract  $productRepository;

    public function __construct(PostRepositoryContract $postRepository, VariousRepositoryContract $variousRepository, StoreProductRepositoryContract $storeProductRepository, ProductRepositoryContract $productRepository)
    {
        //$this->middleware('auth');

        $this->postRepository = $postRepository;

        $this->variousRepository = $variousRepository;

        $this->storeProductRepository = $storeProductRepository;

        $this->productRepository = $productRepository;
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $post = $this->postRepository->findById($request->get('commentable_id'));

            if (!$post){
                return response()->json(['success' => false, 'message' => 'The post not found'], 404);
            }

            $this->postRepository->createCommentOnThisPost($post, $request);

            return response()->json(['success' => true], 201);
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function product(Request $request){

        if ($request->ajax())
        {
            $product = $this->productRepository->findById($request->get('commentable_id'));

            if (!$product){
                return response()->json(['success' => false, 'message' => 'The product not found'], 404);
            }

            $this->productRepository->createCommentOnThisProduct($product, $request);

            return response()->json(['success' => true], 201);
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function various(Request $request){

        if ($request->ajax())
        {
            $various = $this->variousRepository->findById($request->get('commentable_id'));

            if (!$various){
                return response()->json(['success' => false, 'message' => 'The product not found'], 404);
            }

            $this->variousRepository->createCommentOnThisVarious($various, $request);

            return response()->json(['success' => true], 201);
        }
        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function storeProduct(Request $request){

        if ($request->ajax())
        {
            $product = $this->storeProductRepository->findById($request->get('commentable_id'));

            if (!$product){
                return response()->json(['success' => false, 'message' => 'The product not found'], 404);
            }

            $this->storeProductRepository->createCommentOnThisStoreProduct($product, $request);

            return response()->json(['success' => true], 201);
        }
        return back();
    }



    /**
     * @param $lang
     * @param $post_id
     * @return JsonResponse|RedirectResponse
     */
    public function fetchComment($lang, $post_id)
    {
        if (request()->ajax()){

            $post = $this->postRepository->findById($post_id);

            $comments = $comments = $this->postRepository->getCommentsByPost($post);

            return response()->json(['success' => true, 'comments' => $comments], 200);

        }
        return back();
    }

    /**
     * @param $lang
     * @param $product_id
     * @return JsonResponse|RedirectResponse
     */
    public function fetchCommentProduct($lang, $product_id){

        if (request()->ajax()){

            $product = $this->productRepository->findById($product_id);

            $comments = $this->productRepository->getCommentsByProduct($product);

            return response()->json(['success' => true, 'comments' => $comments], 200);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $various_id
     * @return JsonResponse|RedirectResponse
     */
    public function fetchCommentVarious($lang, $various_id){

        if (request()->ajax()){

            $various = $this->variousRepository->findById($various_id);

            $comments = $this->variousRepository->getCommentsByVarious($various);

            return response()->json(['success' => true, 'comments' => $comments], 200);
        }
        return back();
    }

    /**
     * @param $lang
     * @param $store_product_id
     * @return JsonResponse|RedirectResponse
     */
    public function fetchCommentStoreProduct($lang, $store_product_id){

        if (request()->ajax()){

            $product = $this->storeProductRepository->findById($store_product_id);

            $comments = $this->storeProductRepository->getCommentsByStoreProduct($product);

            return response()->json(['success' => true, 'comments' => $comments], 200);
        }
        return back();
    }


}
