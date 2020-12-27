<?php


namespace App\Services;


use \DateTime;

trait PostService
{



    /**
     * @param $date
     * @return mixed
     */
    function translateDate($date){

        if(app()->getLocale() === 'en'){
            return $date;
        }

        $detach = explode(' ', $date);

        $month  = strtolower(__( current($detach) ));

        if(count($detach) > 2)

            return trim($detach[1], ',')." {$month} ".end($detach);

        return "{$month} ".end($detach);
        //str_replace(current($detach), $month, $date);
    }

    function timeAgo(string $created_at){

        $datetime = new DateTime($created_at);
        $diff = date_create("now")->diff($datetime);

        $str = '';
        if($diff->y >= 1)
            return $str = plural($diff->y, 'year');
        if($diff->m >= 1)
            return $str = plural($diff->m, 'month');
        if($diff->d >= 1)
            return $str = plural($diff->d, 'day');
        if($diff->h >= 1)
            return $str = plural($diff->h, 'hour');
        if($diff->i >= 1)
            return $str = plural($diff->i, 'minute');

        return  $str = __("Just now");
        //return $str = plural($diff->s, 'second');
    }
}
