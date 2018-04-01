<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

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
            $grid->email('手机');
            $grid->address('钱包地址')->display(function ($address) {
                return "<code>0x".$address."</code>";
            });

            $grid->invite_count('邀请数量')->sortable()->display(function ($count) {
                return "<a href='/admin/users?from={$this->id}'>$count</a>";
            });
            $grid->vip('用户等级')->sortable();
            $grid->bonus('总奖励');
            $grid->sent_bonus('已发奖励');
            $grid->should_send_bonus('应发奖励')->sortable()->display(function ($bonus) {
                if ($bonus) {
                    $form = '<form method="POST" action="/admin/users/send_bonus">'.csrf_field().'<input type="hidden" name="uid" value="'.$this->id.'">';
                    return $form."<button type=\"submit\" class=\"btn btn-danger\">$bonus</button></form>";
                }

                return $bonus;
            });

            $grid->created_at('注册日期')->display(function () {
                return $this->created_at->format('Y-m-d');
            });
        });

        $grid->disableCreation();
        $grid->disableExport();

        $grid->filter(function($filter){
            $filter->disableIdFilter();

            $filter->equal('email', '手机号')->placeholder('手机号');
            $filter->equal('from', '邀请人')->placeholder('邀请人 ID');
            $filter->gt('invite_count', '邀请人数超过')->placeholder('人数');
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

    public function sendBonus(Request $request)
    {
        $uid = $request->input('uid');

        $user = User::find($uid);

        if ($user) {
            $user->sent_bonus = $user->bonus;
            $user->updateBonus();
        }

        return back();
    }
}
