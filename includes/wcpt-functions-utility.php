<?php
/**
 * WCPT utility functions
 *
 * @author 		Emil Kjær Eriksen <emilxeriksen@gmail.com>
 * @package 	WCPT/Includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Insert a value or key/value pair after a specific key in an array.  If key doesn't exist, value is appended
 * to the end of the array.
 *
 * @see https://gist.github.com/wpscholar/0deadce1bbfa4adb4e4c
 *
 * @param array  $array Array to insert in.
 * @param string $key   Key to insert after.
 * @param array  $new   Array to insert.
 *
 * @return array
 */
function wcpt_array_insert_after( $array, $key, $new ) {
	$keys = array_keys( $array );
	$index = array_search( $key, $keys );
	$pos = false === $index ? count( $array ) : $index + 1;

	return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
}
