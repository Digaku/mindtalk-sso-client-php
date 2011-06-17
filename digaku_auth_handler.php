<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           digaku_auth_handler.php
 * License:			MIT
 * Summary:        Auth handler.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("inc.php");

$client_id = $_GET['client_id'];
$code = $_GET['code'];

$rv = url_get_data("http://" . SSO_API_ENDPOINT . "/access_token?code=" . $code . "&client_secret=" . MINDTALK_CLIENT_SECRET);
$rv or die("Cannot get access token");

$rv = urldecode($rv);
$rv = explode("&", $rv);
$access_token = explode("=",$rv[0]);
$access_token = $access_token[1];
$refresh_token = explode("=",$rv[1]);
$refresh_token = $refresh_token[1];

//echo "access_token = " . $access_token . "<br />";
//echo "refresh_token = " . $refresh_token . "<br />";

setcookie("mindtalk_access_token", $access_token, time()+3600, "/", COOKIE_DOMAIN);
setcookie("mindtalk_refresh_token", $refresh_token, time()+3600, "/", COOKIE_DOMAIN);

header("Location: " . BASE_URL);
