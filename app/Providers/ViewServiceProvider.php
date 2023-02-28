<?php

namespace App\Providers;

use App\Models\Shift;
use App\Models\ShiftPattern;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin/shifts/*', function ($view) {

            if (auth()->guard('admin')->check()) {
                $shifts = Shift::all();
                $users = User::all();
                $shift_patterns = ShiftPattern::all();

                $view->with([
                    'users' => $users,
                    'shifts' => $shifts,
                    '$shift_patterns' => $shift_patterns
                ]);
            }
        });
    }
}
