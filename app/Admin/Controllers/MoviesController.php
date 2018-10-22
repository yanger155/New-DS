<?php

namespace App\Admin\Controllers;

use App\Models\Movies;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MoviesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Movies);

        // $grid = Admin::grid(Movie::class, function(Grid $grid){

            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->id('ID')->sortable();
        
            // 第二列显示title字段，由于title字段名和Grid对象的title方法冲突，所以用Grid的column()方法代替
            $grid->column('title');
        
            // 第三列显示director字段，通过display($callback)方法设置这一列的显示内容为users表中对应的用户名
            // $grid->director()->display(function($userId) {
            //     return User::find($userId)->name;
            // });
        
            // 第四列显示为describe字段
            $grid->describe();
        
            // 第五列显示为rate字段
            $grid->rate();
        
            // 第六列显示released字段，通过display($callback)方法来格式化显示输出
            $grid->released('上映?')->display(function ($released) {
                return $released ? '是' : '否';
            });
        
            // 下面为三个时间字段的列显示
            $grid->release_at();
            $grid->created_at();
            $grid->updated_at();
        
            // filter($callback)方法用来设置表格的简单搜索框
            $grid->filter(function ($filter) {
        
                // 设置created_at字段的范围查询
                $filter->between('created_at', 'Created Time')->datetime();
            });
        // });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Movies::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Movies);



        return $form;
    }
}
