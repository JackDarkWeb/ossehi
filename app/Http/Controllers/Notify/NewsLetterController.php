<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NewsLetterRepositoryContract;
use App\Services\NewsLetterService;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    protected NewsLetterService $newsLetterService;
    protected NewsLetterRepositoryContract $newsLetterRepository;

    public function __construct(NewsLetterService $newsLetterService, NewsLetterRepositoryContract $newsLetterRepository)
    {
        $this->newsLetterService = $newsLetterService;
        $this->newsLetterRepository = $newsLetterRepository;
    }

    function create(Request $request){

        $errors = $this->newsLetterService->newsLetterFormRequest($request);

        if (!is_null($errors)){

            return response()->json(['success' => false, 'message' => $errors], 400);
        }

        $this->newsLetterRepository->create($request);

        return response()->json(['success' => true, 'message' => __('Thank you!'), 200]);
    }
}
