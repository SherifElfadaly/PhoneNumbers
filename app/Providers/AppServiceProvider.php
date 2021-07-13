<?php

namespace App\Providers;

use App\Contracts\PhoneNumberRepositoryInterface;
use App\Contracts\PhoneNumberServiceInterface;
use App\Contracts\PhoneNumberUtlInterface;
use App\Repositories\PhoneNumberRepository;
use App\Services\PhoneNumberService;
use App\Utl\PhoneNumberUtl;
use Illuminate\Support\Facades\DB;
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
        $this->app->bind(PhoneNumberRepositoryInterface::class, PhoneNumberRepository::class);
        $this->app->bind(PhoneNumberServiceInterface::class, PhoneNumberService::class);
        $this->app->singleton(PhoneNumberUtlInterface::class, PhoneNumberUtl::class);
        
        /**
         * Register regex function to sqlite
         */
        if (DB::Connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::connection()->getPdo()->sqliteCreateFunction('REGEXP', function ($pattern, $value) {
                $notEqual = false;
                if(strpos($pattern, '!') === 0) {
                    $pattern = ltrim($pattern, '!');
                    $notEqual = true;
                }

                mb_regex_encoding('UTF-8');
                return $notEqual ? ! preg_match($pattern, $value): preg_match($pattern, $value);
            });

        }

    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
