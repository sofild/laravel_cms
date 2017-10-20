<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>后台登录</title>

<link href="/manage/css/bootstrap.min.css" rel="stylesheet">
<link href="/manage/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="/manage/js/html5shiv.js"></script>
<script src="/manage/js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row" id="loginForm" onkeydown="enter(event)">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" name="form1" id="form1" method="post" action="/manage/dologin">
						{{ csrf_field() }}
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="用户名" id="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="密码" id="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">记住密码
								</label>
							</div>
							<a href="javascript:void(0);" onclick="login()" class="btn btn-primary">登 录</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

	<script src="/manage/js/jquery-1.11.1.min.js"></script>
	<script src="/manage/js/bootstrap.min.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})

		function login(){
			var url = $("#form1").attr("action");
			var username = $("#username").val();
			var password = $("#password").val();
			var token = $("input[name='_token']").val();
			if(username==""){
				alert("请输入登录用户名！");
				return false;
			}
			if(username==""){
				alert("请输入登录密码！");
				return false;
			}
			$.ajax({
				type: 'post',
				dataType: 'json',
				data: {username:username,password:password,_token:token},
				url: 'http://' + document.location.host + url
			}).done(function(resp) {
				if (resp) {
					if(resp.status==1000){
						window.location.href = resp.url;
						return false;
					}else{
						alert(resp.msg);
						return false;
					}
				} else {
					alert("登录失败，请重新操作！");
				}
			}).fail(function(resp){
				alert('服务器错误，请刷新页面重新操作！');
			});
		}

		function enter(e){
			var theEvent = e || window.event;
			var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
			if (code == 13) {
				login();
			}
		}
	</script>	
</body>

</html>
