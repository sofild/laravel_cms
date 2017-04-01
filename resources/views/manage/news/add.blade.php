{include file="header" /}
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">文章管理 / 文章添加</li>
			</ol>
		</div><!--/.row-->
						
		<div class="row">
			<div class="col-lg-12"><br /></div>			
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">文章编辑</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form role="form" name="form1" id="form1" enctype="multipart/form-data" method="post" action="/manage/news/add">
							
								<div class="form-group">
									<label>标题</label>
									<input name="title" id="title" class="form-control" placeholder="" value="{{ $data["info"]["title"] }}">
								</div>
																
								<div class="form-group">
									<label>主图</label>
									<input type="file" name="pic">
									<p class="help-block">jpg、gif、png  can be uploaded.</p>
								</div>
								
								<div class="form-group">
									<label>描述</label>
									<textarea class="form-control" rows="3" name="description" id="description">{{ $data["info"]["description"] }}</textarea>
								</div>

								<div class="form-group">
									<label>分类</label>
									<select class="form-control" name="cate_id">
										<option value="0">请选择</option>
										@foreach ($data["cate"] as $k =>$v)
											<option value="{{ $v['id'] }}" @if($v['id']==$data['info']['cate_id']) selected @endif>{{ $v["name"] }}</option>
											@if (!empty($v['child']))
												@foreach ($v["child"] as $ck =>$cv)
													<option value="{{ $cv['id'] }}" @if($cv['id']==$data['info']['cate_id']) selected @endif>|-{{ $cv["name"] }}</option>
													@if (!empty($cv['child']))
														@foreach ($cv["child"] as $cck =>$ccv)
															<option value="{{ $ccv['id'] }}" @if($ccv['id']==$data['info']['cate_id']) selected @endif>|---{{ $ccv["name"] }}</option>
														@endforeach
													@endif
												@endforeach
											@endif
										@endforeach
									</select>
								</div>

								<div class="form-group" style="height: 600px;">
									<label>内容</label>
									<textarea name="content" id="content" style="height:450px;">{{ $data["info"]["content"] }}</textarea>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">&nbsp;提&nbsp;&nbsp;交&nbsp;</button>
									<button type="reset" class="btn btn-default"> &nbsp;重&nbsp;&nbsp;置&nbsp;</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->


	<script type="text/javascript" charset="utf-8" src="/static/manage/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/manage/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/static/manage/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
    	var ue = UE.getEditor('content');
    </script>
{include file="footer" /}