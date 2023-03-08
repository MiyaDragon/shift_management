<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    private AdminUser $admin_user;

    /**
     * テストデータ作成
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->admin_user = AdminUser::factory()->create();
    }

    /**
     * 管理者管理画面表示テスト
     */
    public function test_admin_user_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/admin_user');

        $response->assertOk();
    }

    /**
     * 管理者作成テスト
     */
    public function test_admin_user_cab_be_register(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/admin_user');

        $response->assertOk();

        $response = $this->post(route('admin.admin_user.store'), [
            'name' => 'テスト ユーザー',
            'email' => 'test@example.com',
            'telephone_number' => '01234567890',
            'password' => 'password123',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('admin/admin_user');

        // 作成したレコードが存在するか確認
        $this->assertDatabaseHas('admin_users', ['name' => 'テスト ユーザー']);
    }

    /**
     * 管理者更新テスト
     */
    public function test_admin_user_cab_be_updated(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/admin_user');

        $response->assertOk();

        $admin_user = AdminUser::factory()->create();

        $response = $this->put(route('admin.admin_user.update', ['admin_user' => $admin_user]), [
            'name' => 'テスト ユーザー 更新',
            'email' => 'update@example.com',
            'telephone_number' => '09876543210',
            'password' => '123password',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect('admin/admin_user');

        $admin_user->refresh();

        $this->assertSame('テスト ユーザー 更新', $admin_user->name);
        $this->assertSame('update@example.com', $admin_user->email);
    }

    /**
     * 管理者削除テスト
     */
    public function test_admin_user_cab_be_deleted(): void
    {
        // 削除する管理者
        $admin_user = AdminUser::factory()->create();

        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/admin_user');

        $response->assertOk();

        $response = $this->delete(
            route('admin.admin_user.destroy', ['admin_user' => $admin_user])
        );

        $response->assertSessionHasNoErrors();

        // 論理削除されているか確認
        $this->assertSoftDeleted($admin_user);
    }
}
