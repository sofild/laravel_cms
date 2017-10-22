<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>page</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/admin/dist/main.css">
	<link rel="stylesheet" name="theme" href="">
	<link rel="icon" href="./td_icon.ico" type="image/x-icon" />
	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
			background: #f0f0f0;
		}
		.lock-screen-back{
			border-radius: 50%;
			z-index: -1;
			box-shadow: 0 0 0 0 #667aa6 inset;
			position: fixed;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-50%);
			transition: all 3s;
		}
	</style>
	<script>
		window.DATA = {!! $data !!};
	</script>
</head>
<body>
<div id="app"></div>
<div class="lock-screen-back" id="lock_screen_back"></div>
<script type="text/javascript" src="/admin/dist/vendors.js"></script>
<script type="text/javascript" src="/admin/dist/main.js"></script>
</body>
</html>