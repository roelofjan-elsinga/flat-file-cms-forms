<?php


namespace FlatFileCms\Forms;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/flatfilecms-forms.php.php', 'flatfilecms-forms');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/flatfilecms-forms.php' => config_path('flatfilecms-forms.php'),
        ], 'config');

        $this->commands([
            GenerateFormCommand::class
        ]);
    }
}
