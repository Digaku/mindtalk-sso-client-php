<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           digaku_auth_handler.php
 * Summary:        Digaku SSO engine example.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("inc.php");

$digaku_connect = $_GET['digaku_connect'];
$digaku_session_id = $_GET['digaku_session_id'];

setcookie("digaku_connect", $digaku_connect, time()+3600, "/", "." . DOMAIN_NAME);
setcookie("digaku_session_id", $digaku_session_id, time()+3600, "/", "." . DOMAIN_NAME);

header("Location: " . BASE_URL);
