<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户列表');
            $content->description('注册用户以及推广情况');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->address('钱包地址')->display(function ($address) {
                return "<code>0x".$address."</code>";
            });

            $grid->invitee('邀请用户')->display(function ($users) {
                $lines = array_map(function ($user) {
                    return '<option>'.$user['email'].'</option>';
                }, $users);

                return '<select>'.join("\n", $lines).'</select> 共 '.count($users).' 个';
            });

            $grid->bonus('已发奖励');

            $grid->level('用户等级')->display(function () {
                return count($this->invitee);
            });
            $grid->column('应发奖励')->display(function () {
                return 1;
            });


            $grid->created_at('注册时间');
        });

        $grid->disableCreation();
        $grid->disableExport();

        $grid->filter(function($filter){
            $filter->disableIdFilter();

            $filter->equal('email', '手机号')->placeholder('手机号');
        });


        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
