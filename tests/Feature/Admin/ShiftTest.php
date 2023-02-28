<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use App\Models\Shift;
use App\Models\ShiftPattern;
use App\Models\User;
use App\Models\Workday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShiftTest extends TestCase
{
    use RefreshDatabase;

    private AdminUser $admin_user;
    private Shift $shift;
    private ShiftPattern $shift_pattern;

    /**
     * テストデータ作成
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->admin_user = AdminUser::factory()->create();
        $this->shift = Shift::factory()->create(['year_month' => today()->format('Y-m')]);
    }

    /**
     * シフト管理画面表示テスト
     */
    public function test_shift_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/shift');

        $response->assertOk();
    }

    /**
     * シフト管理詳細画面表示テスト
     */
    public function test_shift_detail_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/shift/' . $this->shift->id);

        $response->assertOk();
    }

    /**
     * シフト作成テスト
     */
    public function test_new_shift_can_register(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/shift/create');

        $response->assertOk();

        $year_month = today()->addMonth(rand(1, 12))->format('Y-m');
        $response = $this->post('/admin/shift', [
            'year_month' => $year_month,
        ]);

        // 作成されたデータ
        $shift = Shift::where('year_month', $year_month)->first();

        $response->assertRedirect(route('admin.shift.show', ['shift' => $shift]));
    }

    /**
     * シフト更新テスト
     */
    public function test_shift_can_be_updated(): void
    {
        $url = '/admin/shift/' . $this->shift->id . '/edit';
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get($url);

        $response->assertOk();

        $shift_pattern = ShiftPattern::factory()->create();
        $workday = Workday::factory()->create([
            'user_id' => User::factory()->create()->id,
            'shift_id' => $this->shift->id,
            'shift_pattern_id' => ShiftPattern::factory()->create()->id,
        ]);

        $url = '/admin/shift/update';
        $response = $this
            ->put($url, [
                'id' => $workday->id,
                'shift_pattern_id' => $shift_pattern->id,
            ]);

        $response->assertSessionHasNoErrors();

        $workday->refresh();

        $this->assertSame($shift_pattern->id, $workday->shift_pattern_id);
    }

    /**
     * シフト展開テスト
     */
    public function test_shift_can_be_deployment(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/shift/deployment');

        $response->assertOk();
    }

    /**
     * 出勤要請テスト
     */
    public function test_shift_can_be_attendance_request(): void
    {
        $response = $this
            ->actingAs($this->admin_user, 'admin')
            ->get('/admin/shift/attendance_request');

        $response->assertOk();
    }
}
