<?php


namespace App\Helpers;


use Illuminate\Http\RedirectResponse;
use PragmaRX\Countries\Package\Countries;
use Stevebauman\Location\Facades\Location;

class Helper
{
    /**
     * @param $routeName
     * @return RedirectResponse
     */
    static function redirect($routeName){
        return redirect()->route($routeName, ['lang' => app()->getLocale()]);
    }

    /**
     * @return object
     */
    static function userLocation(){

        $position = Location::get(request()->ip());

        if (!$position){

            return (object)([
                'ip' => request()->ip(),
                'country' => 'Benin',
                'city' => 'Porto-Novo',
                'state' => 'Ouéme',
                'postal_code' => '02BP1285',
                'iso_code' => 'bj'
            ]);
        }

        return (object)([
            'ip' => request()->ip(),
            'country' => $position->countryName,
            'city' => $position->cityName,
            'state' => $position->regionName,
            'postal_code' => $position->zipCode,
            'iso_code' => $position->countryCode
        ]);
    }



    static function getCountries(){
        $countries = new Countries();
        return $countries->all()->pluck('name.common')->toArray();
    }

     /**
     * @param string $country
     * @return mixed
     */
    static function getStates(string $country){

        $countries = new Countries();

        return $countries->where('name.common', $country)
            ->first()
            ->hydrateStates()
            ->states
            ->sortBy('name')
            ->pluck('name', 'postal');
    }


    /**
     * @param null $country
     * @return string
     */
    static function prefixPhone($country = null){

        if (is_null($country)){
            $country = self::userLocation()->country;
        }

        $country_with_indicative = [
            "United States" => 1,
            "Canada" => 1,
            "Russia" => 7,
            "Kazakhstan" => 7,
            "Uzbekistan" => 998,
            "Egypt" => 20,
            "South Africa" => 27,
            "Greece" => 30,
            "Netherlands" => 31,
            "Belgium" => 32,
            "France" => 33,
            "Spain" => 34,
            "Hungary" => 36,
            "Italy" => 39,
            "Vatican" => 39,
            "Romania" => 40,
            "Liechtenstein" => 423,
            "Switzerland" => 41,
            "Austria" => 43,
            "United Kingdom" => 44,
            "Denmark" => 45,
            "Sweden" => 46,
            "Norway" => 47,
            "Poland" => 48,
            "Germany" => 49,
            "Peru" => 51,
            "Mexico" => 52,
            "Cuba" => 53,
            "Argentina" => 54,
            "Brazil" => 55,
            "Chile" => 56,
            "Colombia" => 57,
            "Venezuela" => 58,
            "Malaysia" => 60,
            "Australia" => 61,
            "Christmas Island" => 61,
            "Indonesia" => 62,
            "Philippines" => 63,
            "New Zealand" => 64,
            "Singapore" => 65,
            "Thailand" => 66,
            "Japan" => 81,
            "South Korea" => 82,
            "Vietnam" => 84,
            "China" => 86,
            "Turkey" => 90,
            "India" => 91,
            "Pakistan" => 92,
            "Afghanistan" => 93,
            "Sri Lanka" => 94,
            "Iran" => 98,
            "Morocco" => 212,
            "Algeria" => 213,
            "Tunisia" => 216,
            "Libya" => 218,
            "Gambia" => 220,
            "Senegal" => 221,
            "Mauritania" => 222,
            "Mali" => 223,
            "Guinea" => 224,
            "Ivory Coast" => 225,
            "Burkina Faso" => 226,
            "Niger" => 227,
            "Togo" => 228,
            "Benin" => 229,
            "Maurice" => 230,
            "Liberia" => 231,
            "Sierra Leone" => 232,
            "Ghana" => 233,
            "Nigeria" => 234,
            "Chad" => 235,
            "Central African Republic" => 236,
            "Cameroon" => 237,
            "Cap Verde" => 238,
            "Sao Tome and Principe" => 239,
            "Equatorial Guinea" => 240,
            "Gabon" => 241,
            "Bahamas" => 1,
            "Republic Of The Congo" => 242,
            "Democratic Republic Of The Congo" => 243,
            "Angola" => 244,
            "Guinea Bissau" => 245,
            "Barbados" => 246,
            "Ascension" => 247,
            "Seychelles" => 248,
            "Sudan" => 249,
            "Rwanda" => 250,
            "Ethiopia" => 251,
            "Ukraine" => 380,
            "Saudi Arabia" => 966,
        ];
        return (array_key_exists($country, $country_with_indicative) ? "+{$country_with_indicative[$country]}" : '');
    }

}
