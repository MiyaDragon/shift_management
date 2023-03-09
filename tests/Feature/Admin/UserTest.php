<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private AdminUser $admin_user;
    private Position $positon;

    /**
     * テストデータ作成
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->admin_user = AdminUser::factory()->create();
        $this->positon = Position::factory()->create();
    }

    /**
     * ユーザー画面表示テスト
     */
    public function test_user_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/user');

        $response->assertOk();
    }

    /**
     * ユーザー作成テスト
     */
    public function test_admin_user_cab_be_register(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/user/create');

        $response->assertOk();

        $response = $this->post(route('admin.user.store'), [
            'position_id' => $this->positon->id,
            'name' => 'テスト ユーザー',
            'email' => 'test@example.com',
            'telephone_number' => '01234567890',
            'password' => 'password123',
            'prescribed' => 5,
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('admin/user');

        // 作成したレコードが存在するか確認
        $this->assertDatabaseHas('users', ['name' => 'テスト ユーザー']);
    }

    /**
     * ユーザー更新テスト
     */
    public function test_user_cab_be_updated(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/user');

        $response->assertOk();

        // 更新するユーザー
        $user = User::factory()->create(['position_id' => $this->positon->id]);
        $positon = Position::factory()->create();

        $response = $this->put(route('admin.user.update', ['user' => $user]), [
            'position_id' => $positon->id,
            'name' => 'テスト ユーザー 更新',
            'email' => 'update@example.com',
            'telephone_number' => '09876543210',
            'password' => '123password',
            'prescribed' => '2.5',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('admin/user');

        $user->refresh();

        $this->assertSame('テスト ユーザー 更新', $user->name);
        $this->assertSame('update@example.com', $user->email);
    }

    /**
     * 管理者削除テスト
     */
    public function test_user_cab_be_deleted(): void
    {
        // 削除するユーザー
        $user = User::factory()->create(['position_id' => $this->positon->id]);

        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/user');

        $response->assertOk();

        $response = $this->delete(
            route('admin.user.destroy', ['user' => $user])
        );

        $response->assertSessionHasNoErrors();

        // 論理削除されているか確認
        $this->assertSoftDeleted($user);
    }
}
