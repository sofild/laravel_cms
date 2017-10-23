<html>
	<head>
		<link href="/manage/css/bootstrap.min.css" rel="stylesheet">
		<link href="/manage/css/datepicker3.css" rel="stylesheet">
		<link href="/manage/css/styles.css" rel="stylesheet">

		<script src="/manage/js/jquery-1.11.1.min.js"></script>
		<script src="/manage/js/bootstrap.min.js"></script>

		<!--[if lt IE 9]>
		<script src="/manage/js/html5shiv.js"></script>
		<script src="/manage/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">
							<form role="form" name="form1" id="form1" enctype="multipart/form-data" method="post" action="/manage/upload">
								{{ csrf_field() }}
								<div class="form-group">
									<label>图片</label>
									<div class="col-sm-3 col-lg-5">
										<input type="file" name="upload" id="uploadFile" onchange="uploadImage()">
										<p class="help-block">jpg、gif、png  can be uploaded.</p>
									</div>
									<div class="col-sm-9 col-lg-7" id="imgShow">
										@if ($data["info"]["pic"]!='')
											<img src="{{ $data['info']['pic'] }}" width="100px" height="100px" />
										@endif
									</div>
								</div>
						</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

	</div><!--/.main-->


	<script type="text/javascript">
        //文件上传
        function uploadImage() {

            $("#form1").submit();

        }
	</script>
	</body>
</html>