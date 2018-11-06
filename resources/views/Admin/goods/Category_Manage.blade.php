<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>           	
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
<title>商品分类</title>
</head>

<body>
 <div class="margin clearfix">
   <div class="border clearfix">
       <span class="l_f">
        <a href="/category_charge/create" id="Competence_add" class="btn btn-warning" title="添加分类"><i class="fa fa-plus"></i> 添加分类</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
       </span>
       <span class="r_f">共：<b>5</b>类</span>
     </div>
     <div class="compete_list">
       <table id="sample-table-1" class="table table-striped table-bordered table-hover">
		 <thead>
			<tr>
			  <th class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
			  <th>编号</th>
			  <th>分类名称</th>
              <th>上级ID</th>
			  <th>分类路径</th>
			  <!-- <th class="hidden-480"></th>       -->
			  <th class="hidden-480">操作</th>
             </tr>
		    </thead>
             <tbody>
			@foreach($data as $v)
			  <tr>
				<td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
				<td>{{$v['id']}}</td>
				<td>{!!str_repeat('&nbsp;', 8*(count(explode('-',$v['category_path']))-2)) . $v['category_name']!!}</td>
				<td class="hidden-480">{{$v['parent_id']}}</td>
				<td>{{$v['category_path']}}</td>

				<td>
                 <a title="编辑" onclick="Competence_modify('560')" href="/category_charge/{{$v['id']}}/edit"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120">编辑</i></a>        
                 <a title="删除" onclick="return confirm('确定要删除吗？该分类下可能存在子分类哟，如果删除，子分类也会被删除！~');" href="/category_del{{$v['id']}}" id="del" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120">删除</i></a>
				 <!-- <a  id="/category_charge/" name="{{$v['id']}}" onclick="del(this);return false;" class="btn btn-xs btn-warning fa fa-edit bigger-120" >删除</a> -->
				</td>
			   </tr>
			@endforeach			
		      </tbody>
	        </table>
			<a href="#">上一页</a>
			<a href="#">下一页</a>
     </div>
 </div>
 <!--添加权限样式-->
 <!-- <div id="Competence_add_style" style="display:none">
   <div class="Competence_add_style">
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限名称 </label>
       <div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  name="权限名称" class="col-xs-10 col-sm-5"></div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限说明 </label>
       <div class="col-sm-9"><textarea name="权限说明" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
	</div>
   </div> 
  </div>-->
</body>
</html>
<script src="/js/jquery.min.js"></script>
<script>

// function del(node) {
//     var url = node.id;/*得到id的值*/
// 	var id = node.name;
// 	// alert(id);
// 	confirm_ = confirm('确定要删除吗?');
// 	if(confirm_){
// 		// $.ajaxSetup({
// 		// 	headers: {
// 		// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		// 	}
// 		// });
// 		$.ajax({

// 			// console.log(url);
// 			url:url,/*url也可以是json之类的文件等等*/
// 			type:'DELETE',/*DELETE、POST */
// 			data:{
// 				'_token':'{{@csrf_field}}'
// 				'id':id
// 			},
// 			success:function (result) {
				
// 			}
// 		})
// 	}
// };




	// $('a').click(function(){
	// 	// 获取url
	// 	var url = $(this).attr('href');
	// 	// alert(url);
	// 	// 发一个提示框，确认删除吗？
	// 	confirm_ = confirm('This action will delete current order! Are you sure?');
	// 	if(confirm_){
	// 		$.ajax({
	// 			type:"DELETE",
	// 			url:url,
	// 			dataType:"json",
	// 			headers:{
	// 				"Content-Type": "application/json",
	// 				"X-HTTP-Method-Override": "DELETE"
	// 			}
	// 			success:function(data){
					
	// 			}
	// 		});
	// 	}
	// });
</script>