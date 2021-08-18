<?php
//namespace App\Helpers;

use \App\Helpers\HashGeneraor;
use \App\Helpers\Hashids;

function enc( $input )
{
	$hash = new Hashids( "supersalt" );
	return $hash->encode( $input );
}

function dec( $input )
{
	$hash = new Hashids( "supersalt" );
	$hash = $hash->decode( $input );
	return ($hash) ? $hash[0] : null ;
}

function inlineHighlight( $str, $term)
{
    $replace = "<span class='text-success'>{$term}</span>" ;
    return str_ireplace( $term, $replace, $str );
}


