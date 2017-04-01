@include('manage.header')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">分类管理 / 分类添加</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12"><br /></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">分类编辑</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <form role="form" name="form1" id="form1" enctype="multipart/form-data" method="post" action="/cate/add">

                            <div class="form-group">
                                <label>名称</label>
                                <input name="name" id="name" class="form-control" placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <label>父级分类</label>
                                <select class="form-control" name="cate_id">
                                    <option value="0">请选择</option>
                                    @foreach ($data["cate"] as $k =>$v)
                                        <option value="{{ $v['id'] }}">{{ $v["name"] }}</option>
                                        @if (!empty($v['child']))
                                            @foreach ($v["child"] as $ck =>$cv)
                                                <option value="{{ $cv['id'] }}">|-{{ $cv["name"] }}</option>
                                                @if (!empty($cv['child']))
                                                    @foreach ($cv["child"] as $cck =>$ccv)
                                                        <option value="{{ $ccv['id'] }}">|---{{ $ccv["name"] }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                        @endforeach
                                </select>
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
@include('manage.footer')