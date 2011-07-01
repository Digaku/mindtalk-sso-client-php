Mindtalk SSO Client example in PHP
===================================

This package contains example howto use Mindtalk API fully implemented in PHP.

Files
----------

	config_example.php 			Example configuration file, you should first rename it to `config.php`
								and edit as needs, follow the instruction inside.	
	inc.php 					-
	index.php 					Main front page.
	digaku_auth_handler.php   	Auth handler for handle OAuth call `redirect_uri`.
	logout.php 					For logout (clear access_token).
	

Authentication & Authorization
-------------------------------

Mindtalk API using OAuth v2, so you needs to know how OAuth work http://en.wikipedia.org/wiki/OAuth

Screenshot
-----------

![](http://i.imgur.com/owdah.png)

Installation
-------------

$ git clone git://github.com/Digaku/mindtalk-sso-client-php.git


See also
---------

* http://developer.digaku.com/api


