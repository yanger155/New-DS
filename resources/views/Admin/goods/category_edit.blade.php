<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/css/style.css" />
	<link href="/assets/css/codemirror.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/ace.min.css" />
	<link rel="stylesheet" href="/font/css/font-awesome.min.css" />
	<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/typeahead-bs2.min.js"></script>
	<script src="/assets/js/jquery.dataTables.min.js"></script>
	<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
	<script src="/assets/layer/layer.js" type="text/javascript"></script>
	<script src="/assets/laydate/laydate.js" type="text/javascript"></script>
	<script src="/js/dragDivResize.js" type="text/javascript"></script>
	<title>商品分类</title>
</head>

<body>
	<div class="Competence_add_style clearfix">
		<form action="/category_charge/{{$data1->id}}" method="post">
			@csrf
			{{method_field('PUT')}}
			<div class="left_Competence_add">
				<div class="title_name">添加分类</div>

				<div class="Competence_add">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1">分类名称</label>
						<div class="col-sm-9">
							<input type="text" id="form-field-1" placeholder="" name="category_name" class="col-xs-10 col-sm-5" value="{{$data1->category_name}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 一级ID </label>
						<div class="col-sm-9">
							<select name="cat1">
								<option value="">请选择</option>
								@foreach($data2 as $v)
								<option value="{{$v->id}}">{{$v->category_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 二级ID </label>
						<div class="col-sm-9">
							<select name="cat2">
								<option value="">请选择</option>
							</select>
						</div>
					</div>
					<div class="from-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 三级ID </label>
						<div class="col-sm-9">
							<select name="cat3">
								<option value="">请选择</option>
							</select>
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 二级ID </label>
						<div class="col-sm-9">
							<select name="cat1" id="">
								<option value="">请选择</option>
								<option value=""></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 三级ID </label>
						<div class="col-sm-9">
							<select name="cat1" id="">
								<option value="">请选择</option>
								<option value=""></option>
							</select>
						</div>
					</div> -->

					<!--按钮操作-->
		
						<div class="Button_operation">
								<input type="submit" value="保存并提交" onclick="article_save_submit();" class="btn btn-primary radius">
								<input type="submit" value="返回上一步" onclick="article_save();" class="btn btn-secondary  btn-warning">
								<input type="submit" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="layer_close();" class="btn btn-default radius">
							<!-- <button onclick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="fa fa-save "></i>
								保存并提交</button> -->
							<!-- <button onclick="article_save();" class="btn btn-secondary  btn-warning" type="button"><i class="fa fa-reply"></i>
								返回上一步</button>
							<button onclick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button> -->
						</div>
				
				</div>
			</div>
		</form>
	</div>
	</div>
</body>

</html>
<script src="/js/jquery.min.js"></script>
<script>
		// 一级ID
		$("select[name=cat1]").change(function(){
			// alert('aaaa');
			var id = $(this).val()
			// alert(id);
			if(id!=""){
				$.ajax({
					type:"get",
					url:"/ajax_getcat/"+id,
					// data:{id}
					dataType:"json",
					success:function(data)
					{
						// alert(data);
						var str = '';
						if(data == "")
						{
							str += '<option value="">请选择</option>'
						}
						else
						{
							str += '<option value="">请选择</option>'
							for(var i=0;i<data.length;i++)
							{
								str += '<option value='+ data[i].id +'>'+ data[i].category_name+'</option>';
							}
						}
						$("select[name=cat2]").html(str);
						// trigger() 方法触发被选元素的指定事件类型
						$("select[name=cat2]").trigger('change');
						
					}
				});
			}
		});

		$("select[name=cat2]").change(function(){
			var id = $(this).val();
			// alert(id);

			if(id != "")
			{
				$.ajax({
					type: "GET",
					url: "/ajax_getcat/"+id,
					dataType:"json",
					success:function(data)
					{
						// alert(data);
						var str = '';
						if(data == "")
						{
							str += '<option value="">请选择</option>'
						}
						else
						{
							str += '<option value="">请选择</option>';
							for(var i=0;i<data.length;i++)
							{
								str += '<option value='+ data[i].id +'>'+ data[i].category_name+'</option>';
							}
						}
						$("select[name=cat3]").html(str);
						// trigger() 方法触发被选元素的指定事件类型
						// $("select[name=catid2]").trigger('change');
						
					}
				});
			}
		})
		
</script>
<script type="text/javascript">
	//初始化宽度、高度  
	$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	$(".Assign_style").width($(window).width() - 500).height($(window).height()).val();
	$(".Select_Competence").width($(window).width() - 500).height($(window).height() - 40).val();
	//当文档窗口发生改变时 触发  
	$(window).resize(function () {

		$(".Assign_style").width($(window).width() - 500).height($(window).height()).val();
		$(".Select_Competence").width($(window).width() - 500).height($(window).height() - 40).val();
		$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	});
	/*字数限制*/
	function checkLength(which) {
		var maxChars = 200; //
		if (which.value.length > maxChars) {
			layer.open({
				icon: 2,
				title: '提示框',
				content: '您出入的字数超多限制!',
			});
			// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
			which.value = which.value.substring(0, maxChars);
			return false;
		} else {
			var curr = maxChars - which.value.length; //250 减去 当前输入的
			document.getElementById("sy").innerHTML = curr.toString();
			return true;
		}
	};
	/*按钮选择*/
	$(function () {
		$(".permission-list dt input:checkbox").click(function () {
			$(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
		});
		$(".permission-list2 dd input:checkbox").click(function () {
			var l = $(this).parent().parent().find("input:checked").length;
			var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
			if ($(this).prop("checked")) {
				$(this).closest("dl").find("dt input:checkbox").prop("checked", true);
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
			}
			else {
				if (l == 0) {
					$(this).closest("dl").find("dt input:checkbox").prop("checked", false);
				}
				if (l2 == 0) {
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
				}
			}

		});
	});

</script>