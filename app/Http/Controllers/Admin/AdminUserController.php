<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminUserRequest;
use App\Http\Requests\Admin\UpdateAdminUserRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * 管理者一覧画面
     *
     * @return View
     */
    public function index()
    {
        $admin_users = AdminUser::all();

        return view('admin.admin_users.index', compact('admin_users'));
    }

    /**
     * 管理者作成画面
     *
     * @return View
     */
    public function create()
    {
        return view('admin.admin_users.form');
    }

    /**
     * 管理者作成処理
     *
     * @param  StoreAdminUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminUserRequest $request)
    {
        AdminUser::create($request->validated());

        return to_route('admin.admin_user.index');
    }

    /**
     * 管理者編集画面
     *
     * @param  AdminUser $admin_user
     * @return View
     */
    public function edit(AdminUser $admin_user)
    {
        return view('admin.admin_users.form', compact('admin_user'));
    }

    /**
     * 管理者更新画面
     *
     * @param  UpdateAdminUserRequest  $request
     * @param  AdminUser $admin_user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUserRequest $request, AdminUser $admin_user)
    {
        $admin_user->update($request->validated());

        return to_route('admin.admin_user.index');
    }

    /**
     * 管理者削除処理
     *
     * @param  AdminUser $admin_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $admin_user)
    {
        $admin_user->delete();

        return to_route('admin.admin_user.index');
    }
}
