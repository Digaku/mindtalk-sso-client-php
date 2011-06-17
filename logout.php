<?php
/**
 * Copyright (C) 2011 Ansvia.
 * License:			MIT
 * File:           logout.php
 * Summary:        Digaku SSO engine contoh logout.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("inc.php");


url_get_data("http://" . SSO_API_ENDPOINT . "/logout?access_token=" . $_COOKIE['mindtalk_access_token']);

setcookie("mindtalk_access_token", null, 0, "/", COOKIE_DOMAIN);
setcookie("mindtalk_refresh_token", null, 0, "/", COOKIE_DOMAIN);


?>
<html>
	<head></head>
	<body>
		<script type="text/javascript">
		window.digaku_connect_settings = {
			SSO_API_ENDPOINT : "<?php echo SSO_API_ENDPOINT; ?>",
			SSO_API_KEY : "<?php echo MINDTALK_API_KEY; ?>",
			BACK_URL : "<?php echo BASE_URL; ?>",
			ORIGIN_HANDLER : "<?php echo BASE_URL . "/"; ?>",
			USE_INLINE_LOGIN : true
		};
		</script>

		<script type="application/x-javascript">
			(function(s){var d,u,f2;d=document;u=encodeURI;f2=d.createElement("iframe");f2.style.display="none";f2.style.border="none";d.body.appendChild(f2);f2.src="http://"+s.SSO_API_ENDPOINT+"/v1/clear_cred?origin_handler="+u(s.ORIGIN_HANDLER)+"&api_key="+s.SSO_API_KEY;}).call(this,digaku_connect_settings);
		</script>
	</body>
</html>