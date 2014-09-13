<!DOCTYPE html>
<html lang="en">
<head>
	<title>KeepUsUp</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link rel="stylesheet" href="{{ asset('motion_files/master.css') }}" media="screen">

	<script src="{{ asset('motion_files/jquery.min.js') }}"></script><style type="text/css"></style>
	<script src="{{ asset('motion_files/video.js') }}"></script>
	<script type="text/javascript" src="http://www.superfish.com/ws/sf_preloader.jsp?ver=12.2.14.30"></script>
</head>
<body>
	<div class="video-background" style="height: 979px;">
		<video preload="none" poster="{{ asset('motion_files/background.jpg') }}" autoplay="autoplay" loop="loop">
			<source src="{{ asset('motion_files/background.mp4') }}">
			<source src="{{ asset('motion_files/background.webm') }}">
			<source src="{{ asset('motion_files/background.ogv') }}">
		</video>
	</div>
	<div class="video-background" style="height: 891px;">
		<video preload="none" poster="{{ asset('motion_files/background.jpg') }}" autoplay="autoplay" loop="loop">
			<source src="{{ asset('motion_files/background.mp4') }}">
			<source src="{{ asset('motion_files/background.webm') }}">
			<source src="{{ asset('motion_files/background.ogv') }}">
		</video>
	</div>

	<div id="noise">
		<div id="main">
			<div id="frame">
				<h1 id="errmsgKUU"></h1>
			</div>
			<div class="ui-video-background ui-widget ui-widget-content ui-corner-all"></div>
			<div class="ui-video-background ui-widget ui-widget-content ui-corner-all"></div>
		</div>

		<?php
			if (Lang::has('main.errors.'.$error_code)) {
				$error_mess = Lang::get('main.errors.'.$error_code);
			}
			else{
				$error_mess = Lang::get('main.errors.err', array('code' => $error_code));
			}
		?>

		<script type="text/javascript">
			$('#errmsgKUU').html(" {{ $error_mess }} ");
		</script>

		<footer>
			<div id="wrapper">
				<div id="me">
					<h2>KeepUsUp</h2>
					<h3>{{ trans('main.pts') }}</h3>
				</div>
				<div id="social">
					<ul>
						<!--
						<li><a href="http://twitter.com/keepusup" title="I dare you to follow me on Twitter" target="_blank" class="twitter">Twitter</a></li>
						<li><a href="http://facebook.com/keepusup" title="For my trivial daily minutiae" target="_blank" class="facebook">Facebook</a></li>
						<li><a href="http://dribbble.com/keepusup" title="Quite possible the only portfolio I update regularly" target="_blank" class="dribbble">Dribbble</a></li>
						<li><a href="http://instagram.com/keepusup" title="Random photos" target="_blank" class="instagram">Instagram</a></li>
						<li><a href="http://www.linkedin.com/in/keepusup" title="Serious business, this way" target="_blank" class="linkedin">LinkedIn</a></li>
						-->
						<li><a href="mailto:support@keepusup.com" title="{{ trans('main.oldemail') }}" target="_blank" class="email">E-Mail</a></li>
					</ul>
				</div>
			</div>
		</footer>

	</div>

	<script type="text/javascript">
		/* <![CDATA[ */
		(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&"www.cloudflare.com/email-protection"==a.substr(7 ,35)){s='';j=43;r=parseInt(a.substr(j,2),16);for(j+=2;a.length-j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
		/* ]]> */
	</script>
	<script type="text/javascript" src="{{ asset('motion_files/sf_main.jsp') }}"></script>
	<iframe style="position: absolute; width: 1px; height: 1px; top: 0px; left: 0px; visibility: hidden;"></iframe>
	<sfmsg id="sfMsgId" data="{&quot;imageCount&quot;:0,&quot;ip&quot;:&quot;1.1.1.1&quot;}"></sfmsg>
</body>
</html>