<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * ユーザー一覧画面
     *
     * @return View
     */
    public function index()
    {
        $users = User::with('position')->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * ユーザー作成画面
     *
     * @return View
     */
    public function create()
    {
        $positions = Position::all();

        return view('admin.users.form', compact('positions'));
    }

    /**
     * ユーザー作成処理
     *
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return to_route('admin.user.index');
    }

    /**
     * ユーザー編集画面
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {
        $positions = Position::all();

        return view('admin.users.form', compact('user', 'positions'));
    }

    /**
     * ユーザー更新処理
     *
     * @param  UpdateUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return to_route('admin.user.index');
    }

    /**
     * ユーザー削除処理
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('admin.user.index');
    }
}
