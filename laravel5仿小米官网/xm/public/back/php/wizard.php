<?php

/*
 * MWS Admin v2.1 - Wizard Demo PHP
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */

function getUserAgent() {
	return isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:null;
}

function getUserHostAddress() {
	return isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'127.0.0.1';
}

 $data = $_POST['wizard'];

 echo print_r( $data, true ) . "\nIP Address:\n\t" . getUserHostAddress() . "\n\nBrowser:\n\t" . getUserAgent();
