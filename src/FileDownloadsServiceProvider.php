<?php

namespace Ignite\FileDownloads;

use Ignite\Foundation\Litstack;
use Ignite\Support\Facades\Route as LitstackRoute;
use Illuminate\Support\ServiceProvider;

class FileDownloadsServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lit-files');

        $this->callAfterResolving('lit', function (Litstack $lit) {
            $lit->script(__DIR__.'/../dist/index.js');
        });

        LitstackRoute::post('/file-downloads', FileDownloadsController::class.'@upload')
            ->name('lit-file-upload');
        LitstackRoute::get('/file-downloads', FileDownloadsController::class)->name('file-downloads');

        $this->publishes([
            __DIR__.'/../publish/migrations/create_file-downloads_table.php' => database_path('migrations/'.now()->format('Y_m_d_hms').'_create_file-downloads_table.php'),
        ], 'lit-file-downloads');
    }
}
