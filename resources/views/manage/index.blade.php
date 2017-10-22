<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>page</title>
	<link href=/dist/static/css/app.css rel=stylesheet>
	<script>
		window.DATA = {!! $data !!};
	</script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app"></div>
<!-- built files will be auto injected -->
<script type=text/javascript src=/dist/static/js/manifest.js?version={{time()}}></script>
<script type=text/javascript src=/dist/static/js/vendor.js?version={{time()}}></script>
<script type=text/javascript src=/dist/static/js/app.js?version={{time()}}></script>
</body>
</html>