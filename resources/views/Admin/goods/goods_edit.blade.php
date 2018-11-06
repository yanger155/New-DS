<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
<script type="text/javascript" src="/js/html5.js"></script>
<script type="text/javascript" src="/js/respond.min.js"></script>
<script type="text/javascript" src="/js/PIE_IE678.js"></script>
<![endif]-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css" />
    <link href="/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
    <link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />

    <title>修改商品</title>
</head>

<body>
    <form action="/goods_charge" method="post" enctype="multipart/form-data">
    @csrf
        <h4>基本信息:</h4>
        <hr>
            <table width="100%">
                <tr>
                    <td class="label">商品名称:</td>
                    <td>
                        <input type='text' size="40" name='name' value="{{$data3->name}}">
                    </td>
                </tr>
                <tr>
                    <td class="label">价格:</td>
                    <td>
                        <input type='text' name='price' placeholder="￥" value="{{$data3->price}}"> &nbsp;元
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架:</td>
                    <td>
                        <input type="radio" name="status" value="上架" @if($data3->status == "上架") checked @endif> 上架
                        <input type="radio" name="status" value="下架" @if($data3->status == "下架") checked @endif> 下架
                    </td>
                </tr>
                <tr>
                    <td class="label">商品描述:</td>
                    <td>
                        <textarea name="introduce" id="" cols="80" rows="10">{{$data3->introduce}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌:</td>
                    <!-- 获取品牌信息渲染数据 -->
                    <td>
                        @foreach($data1 as $v)
                        <input type="radio" name="brand_id" value="{{$v->id}}" @if($data3->brand_name == $v->brand_name) checked @endif>{{$v->brand_name}}
                        @endforeach
                    </td>
                </tr>
                <!-- 获取分类信息渲染数据 -->
                <tr>
                    <td class="label">一级分类ID:</td>
                    <td>
                        <select name="cat1">
                            <option value="">选择一级分类</option>
                            @foreach($data2 as $v)
                            <option value="{{$v->id}}">{{$v->category_name}}</option>
                            @endforeach
                       </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">二级分类ID:</td>
                    <td>
                        <select name="cat2">
                            <option value="">选择二级分类</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">三级分类ID:</td>
                    <td>
                        <select name="cat3">
                            <option value="">选择三级分类</option>
                        </select>
                    </td>
                </tr>
            </table>
        <hr>

            
        <h4>商品属性:</h4><input id="btn-attr" type="button" value="添加一个属性">
        @foreach($data4 as $d)
        <hr>
            <div id="attr-container">
                <table width="100%">
                    <tr>
                        <td class="label">属性名称:</td>
                        <td>
                            <input type='text' size="80" name='attr_name[]' value="{{$d->name}}">
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">属性值:</td>
                        <td>
                            <input type='text' size="80" name='attr_value[]' value="{{$d->value}}">
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td>
                            <input onclick="del_attr(this)" type="button" value="删除">
                        </td>
                    </tr>
                </table>
            </div>
        <hr>
        @endforeach

        <!-- 预览图片 -->
        <h4>商品图片:</h4><input id="btn-image" type="button" value="添加一个图片">
        <hr>
            <div id="image-container">
                    <table width="100%">
                        <tr>
                            <td class="label"></td>
                            <td>
                                <input class="preview" type='file' name='image[]'>
                                <input onclick="del_attr(this)" type="button" value="删除">
                            </td>
                        </tr>
                    </table>
            </div>
        <hr>

        <div class="button-div">
                <input type="submit" value=" 提交 " />
                <input type="reset" value=" 重置 " />
        </div>        
    </form>
    
    </div>
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/typeahead-bs2.min.js"></script>
    <script src="/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="/Widget/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" src="/Widget/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script type="text/javascript" src="/Widget/Validform/5.3.2/Validform.min.js"></script>
    <script type="text/javascript" src="/Widget/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
    <script type="text/javascript" src="/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script src="/js/lrtk.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/H-ui.js"></script>
    <script type="text/javascript" src="/js/H-ui.admin.js"></script>

</body>
</html>
<script src="/js/jquery.min.js"></script>
<script>

        function del_attr(o)
        {
            if(confirm("确定要删除吗？"))
            {
                var table = $(o).parent().parent().parent().parent()
                table.prev('hr').remove()
                table.remove()
            }
        }

        var attrStr = `
                <hr>
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="label">属性名称:</td>
                        <td>
                            <input type='text' size="80" name='attr_name[]'>
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">属性值:</td>
                        <td>
                            <input type='text' size="80" name='attr_value[]'>
                            <font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"></td>
                        <td>
                            <input onclick="del_attr(this)" type="button" value="删除">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <hr>`
        $("#btn-attr").click(function(){
            // alert('aaa');
            $("#attr-container").append(attrStr);
        })

        var imageStr = `
                    <hr>
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td class="label"></td>
                            <td>
                                <input class="preview" type='file' name='image[]'>
                                <input onclick="del_attr(this)" type="button" value="删除">
                            </td>
                        </tr>
                        <tbody>
                    </table>
                    <hr>`
        $("#btn-image").click(function(){
            // alert('aaa');
            $("#image-container").append(imageStr);
        })



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
							str += '<option value="">选择二级分类</option>'
						}
						else
						{
							str += '<option value="">选择二级分类</option>'
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
							str += '<option value="">选择三级分类</option>'
						}
						else
						{
							str += '<option value="">选择三级分类</option>'
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