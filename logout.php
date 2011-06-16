<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           logout.php
 * Summary:        Digaku SSO engine example.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("inc.php");

$digaku_connect = $_COOKIE['digaku_connect'];
$digaku_session_id = $_COOKIE['digaku_session_id'];

setcookie("digaku_connect", null);
setcookie("digaku_session_id", null);

?>
<html>
	<head></head>
	<body>
		<script type="application/x-javascript">
			var back_url = "<?php echo BASE_URL; ?>";
			var digaku_connect = "<?php echo $digaku_connect; ?>";
			var session_id = "<?php echo $digaku_session_id; ?>";
			var ifr = document.createElement("iframe");
			ifr.style.display = "none";
			ifr.style.border = "none";
			document.body.appendChild(ifr);
			ifr.src="http://<?php echo SSO_API_ENDPOINT; ?>/v1/logout?back_url=" + encodeURI(back_url) + "&digaku_connect=" + encodeURI(digaku_connect) + "&session_id=" + encodeURI(session_id);
		</script>
	</body>
</html>
