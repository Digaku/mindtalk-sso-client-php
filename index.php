<?php
/**
 * Copyright (C) 2011 Ansvia.
 * File:           index.php
 * License:			MIT
 * Summary:        Digaku SSO client example.
 * First writter:  robin <robin [at] digaku [dot] kom>
 */

require_once("inc.php");

?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Digaku SSO client example</title>
	</head>
	<body>
		
		<h1>Digaku SSO engine Example</h1>
		
		<br />
		
		<?php
		
		
		if ($_COOKIE['mindtalk_access_token']){
			/**
			 * Jika cookie dah di set.
			 */
			$logged_in = FALSE;
			
			/**
			 * Saran untuk disimpan di session lokal atau cache hasil informasi datanya.
			 */
			$data = url_get_data("http://" . MINDTALK_API_ENDPOINT . "/v1/my/info?access_token=" . $_COOKIE['mindtalk_access_token'] . "&rf=json");

			if(isset($data)){
				$rv = json_decode($data, true);
				if(isset($rv) && key_exists("result", $rv)){
					$user = $rv['result'];
					
					echo "<h1>Hi " . $user['name'] . "!</h1>";
			
					echo "<pre>";
					echo "NAME: " . $user['name'] . "\n";
					echo "ID: " . $user['id'];
					echo "</pre>";
					$logged_in = TRUE;
				}else{
					if($rv['error']['code'] != 7){
						echo "Invalid api result.";
						echo "<pre>";
						print_r($rv);
						echo "</pre>";
						die();
					}
				}
			}
		} // endif
		?>
		
		<?php if ($logged_in): ?>
		
		<!--
		JIKA SUDAH LOGIN
		-->
		
		<script type="text/javascript">
		window.logout = function(){
			window.location = "<?php echo BASE_URL; ?>/logout.php";
		};
		</script>
		<button onclick="logout();">Logout</button>
		
		<?php else: ?>
		
		<!--
		JIKA BELUM LOGIN
		-->
		
		<h2>You are not logged in</h2>
		
		<p>Login manually:</p>
		<div>
			<script type="text/javascript">
			window.oauth_login = function(){
				window.location = '<?php echo "http://" . SSO_API_ENDPOINT . "/authorize?client_id=" . MINDTALK_CLIENT_ID . "&redirect_uri=" . OAUTH_CALLBACK; ?>';
			};
			</script>
			<button onclick="oauth_login();">Click to do OAuth proccess</button>
		</div>
		
		
		<!-- <p>Login via inline login:</p> -->
		<dg:login>
		<!--
		Digunakan untuk iframe login dari SSO server.
		Diperlukan apabila parameter USE_INLINE_LOGIN diaktifkan.
		Adapun fitur inline login ini sebenarnya tidak diperlukan,
		tetapi apabila mau, anda bisa mengaktifkannya.
		-->
		</dg:login>
		
		
		<!--
		SSO auto login settings.
		Parameters:
			SSO_API_ENDPOINT -- {String} url auth.mindtalk.com.
			BACK_URL -- {String} base url website ini. Contoh: www.bolalob.tv
			ORIGIN_HANDLER -- {String} url handler yang akan digunakan sebagai callback.
								Pada contoh ini file ada di `digaku_auth_handler.php`.
			USE_INLINE_LOGIN -- {Bool} tampilkan inline login bila perlu (biasanya untuk debugging),
								Harus buat juga element dgml `<dg:login>`, di mana
								yang akan dijadikan placeholder tampilan login.
		-->
		<script type="text/javascript">
		window.digaku_connect_settings = {
			SSO_API_ENDPOINT : "<?php echo SSO_API_ENDPOINT; ?>",
			SSO_API_KEY : "<?php echo MINDTALK_API_KEY; ?>",
			BACK_URL : "<?php echo BASE_URL; ?>",
			ORIGIN_HANDLER : "<?php echo urlencode(BASE_URL . "/digaku_auth_handler.php"); ?>",
			USE_INLINE_LOGIN : false
		};
		</script>


		<script type="application/x-javascript">
			(function(s){var d,u,f2;d=document;u=encodeURI;f2=d.createElement("iframe");f2.style.display="none";f2.style.border="none";d.body.appendChild(f2);f2.src="http://"+s.SSO_API_ENDPOINT+"/v1/cred?origin_handler="+u(s.ORIGIN_HANDLER)+"&api_key="+s.SSO_API_KEY;if(s.USE_INLINE_LOGIN){var elms=d.getElementsByTagName("dg:login");if(elms.length>0){var m=elms[0],f=d.createElement("iframe");f.style.border="none";f.style.minHeight="200px";f.src="http://"+s.SSO_API_ENDPOINT+"/v1/login_ui?origin_handler="+u(s.ORIGIN_HANDLER)+"&api_key="+s.SSO_API_KEY;m.appendChild(f)}};}).call(this,digaku_connect_settings);
		</script>
		<?php endif; ?>

	</body>
</html>
