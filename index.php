<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           index.php
 * Summary:        Digaku SSO engine example.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */


/**
 * Include constanta
 */
require_once("inc.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Digaku SSO client example</title>
	</head>
	<body>
		
		<h1>Digaku SSO engine Example</h1>
		
		<br />
		
		<?php if ($_COOKIE['digaku_connect']): ?>
		
		<?php
		$logged_in = FALSE;
		
		/**
		 * Saran untuk disimpan di session lokal atau cache hasil informasi datanya.
		 */
		$params = array(
			"digaku_connect" => $_COOKIE['digaku_connect'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"session_id" => $_COOKIE['digaku_session_id'],
			"api_key" => SSO_API_KEY,
			"rf" => "json"
		);
		$data = url_post_data("http://" . SSO_API_ENDPOINT . "/v1/user_from_cookie", $params);
		
		if(isset($data)){
			$rv = json_decode($data, true);
			if(isset($rv) && key_exists("result", $rv)){
				$user = $rv['result'];
				
				echo "<h1>Hi " . $user[name] . "!</h1>";
				echo "<h2>You are now logged in via " . $user['client']['name'] . "</h2>";
		
				echo "<pre>";
				echo "NAME: " . $user['name'] . "\n";
				echo "ID: " . $user['id'];
				echo "</pre>";
				$logged_in = TRUE;
			}else{
				if($rv['error']['code'] != 403){
					echo "Invalid api result.";
					echo "<pre>";
					print_r($rv);
					echo "</pre>";
					die();
				}
			}
		}
		
		?>
		
		<?php endif; ?>
		
		<?php if ($logged_in): ?>
		
		<script type="text/javascript">
		window.logout = function(){
			window.location = "<?php echo BASE_URL; ?>/logout.php";
		};
		</script>
		<button onclick="logout();">Logout</button>
		
		<?php else: ?>
		
		<h2>You are not logged in</h2>
		
		<dg:login>
		<!--
		Digunakan untuk iframe login dari SSO server.
		Diperlukan apabila parameter USE_INLINE_LOGIN diaktifkan.
		Adapun fitur inline login ini sebenarnya tidak diperlukan,
		tetapi apabila mau, anda bisa mengaktifkannya.
		-->
		</dg:login>
		
		<?php $origin_handler = urlencode(BASE_URL . "/digaku_auth_handler"); ?>


		<script type="application/x-javascript">
			var SSO_API_ENDPOINT = "<?php echo SSO_API_ENDPOINT; ?>";
			var BACK_URL = "<?php echo BASE_URL; ?>";
			var ORIGIN_HANDLER = "<?php echo $origin_handler; ?>";
			var USE_INLINE_LOGIN = true;
			var ifr = document.createElement("iframe");
			ifr.style.display = "none";
			ifr.style.border = "none";
			document.body.appendChild(ifr);
			ifr.src = "http://" + SSO_API_ENDPOINT + "/v1/cred?origin_handler=" + encodeURI(ORIGIN_HANDLER);
			if(USE_INLINE_LOGIN){
				var elms = document.getElementsByTagName("dg:login");
				if(elms.length > 0){
					var elm = elms[0];
					var ifrl = document.createElement("iframe");
					ifrl.style.border = "none";
					ifrl.style.minHeight = "200px";
					ifrl.src = "http://" + SSO_API_ENDPOINT + "/v1/login_ui?origin_handler=" + encodeURI(ORIGIN_HANDLER);
					elm.appendChild(ifrl);
				}
			}
		</script>
		<?php endif; ?>
		


	</body>
</html>
