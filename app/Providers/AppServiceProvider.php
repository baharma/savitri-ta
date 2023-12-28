<?php

namespace App\Providers;

use App\Models\Hutang;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('piutangs')) {
            $piutang = Piutang::whereDate('tgl_jatuh_tempo_piutang', '<=', Carbon::now())
                ->where('status_pembayaran', 'PENDING')
                ->count();
            $hutang = Hutang::whereDate('tgl_jatuh_tempo', '<=', Carbon::now())
                ->where('status_pembayaran', 'PENDING')
                ->count();

            view()->share([
                'piutang' => $piutang,
                'hutang' => $hutang
            ]);
        }
    }
}
