<?php
/**
 * Copyright (C) 2011 Ansvia.
 * This file is part of Mindtalk.web project.
 * License:			MIT
 * File:           config_example.php
 * Summary:        Example of configuration file.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

/**
 * Example of configuration file.
 * copy this file and rename.
 */

/**
 * Please set DOMAIN_NAME correctly or your browser cannot save cookie
 * and produce infinite redirect loop.
 */
define("DOMAIN_NAME", "[YOUR-DOMAIN-NAME]");
define("COOKIE_DOMAIN", "[YOUR-COOKIE-DOMAIN-NAME]"); // ex: .mydomain.com

define("BASE_URL", "http://". DOMAIN_NAME);

/**
 * SSO API key
 * bisa di dapat di http://www.digaku.com/application/app-list
 * login dulu.
 */
define("SSO_API_KEY", "[YOUR-API-KEY]");


/**
 * SSO API key
 * bisa di dapat di http://www.digaku.com/application/app-list
 * login dulu.
 */
define("MINDTALK_CLIENT_ID", "[YOUR-CLIENT-ID]");
define("MINDTALK_API_KEY", "[YOUR-API-KEY]");
define("MINDTALK_CLIENT_SECRET", "[YOUR-CLIENT-SECRET]");
define("OAUTH_CALLBACK", "http://". DOMAIN_NAME ."/digaku_auth_handler.php");

/**
 * SSO API endpoint.
 * Pada production environment set ke auth.mindtalk.com
 */
define("SSO_API_ENDPOINT", "auth.mindtalk.com");

/**
 * web API endpoint.
 * Pada production environment set ke auth.mindtalk.com
 */
define("MINDTALK_API_ENDPOINT", "api.mindtalk.com");

