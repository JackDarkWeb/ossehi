<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HelperController extends Controller
{

    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public  function setCookieDevise(Request $request){

        if ($request->ajax()){

            if($request->get('devise')) {

                $devise = cookie('devise', $request->get('devise'));

                return response()->json(['success' => true], 200)->withCookie($devise);
            }

            $devise = cookie('devise', 'USD');

            return response()->json(['success' => false])->withCookie($devise);
        }

        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function setCookieStopNewsLetterPop(Request $request){

        if($request->ajax()) {

            $stop_pop = cookie('stop_pop_newsletter', $request->get('stop_pop_newsletter'));

            return response()->json(['success' => true], 200)->withCookie($stop_pop);
        }
        return back();
    }

    public function getStateByCountry(Request $request){

        if ($request->ajax()){

            $country = $request->get('country');

            if (!in_array($country, Helper::getCountries()))

                return response()->json(['success' => false, 'states' => []], 404);

            //dd(Helper::getStates($country));
            return response()->json(['success' => true, 'states' => Helper::getStates($country)], 200);
        }
        return back();
    }


}
