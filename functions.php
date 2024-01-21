<?php

function dateTextToNum($string) {

    $str = strtolower($string);

    if($str == "january") {
        return "1";
    }

    if($str == "february") {
        return "2";
    }

    if($str == "march") {
        return "3";
    }

    if($str == "april") {
        return "4";
    }
    
    if($str == "may") {
        return "5";
    }

    if($str == "june") {
        return "6";
    }

    if($str == "july") {
        return "7";
    }

    if($str == "august") {
        return "8";
    }

    if($str == "september") {
        return "9";
    }

    if($str == "october") {
        return "10";
    }
    
    if($str == "november") {
        return "11";
    }

    if($str == "december") {
        return "12";
    }

    return "13";

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getTimeAgo( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

?>