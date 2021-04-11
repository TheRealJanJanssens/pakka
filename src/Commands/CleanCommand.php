<?php

namespace TheRealJanJanssens\Pakka\Commands;

use Illuminate\Console\Command;

class CleanCommand extends Command
{
    public $signature = 'pakka-clean';

    public $description = 'My command';

    public function clean($str)
    {
        if (is_file($str)) {
            chmod($str, 0777);

            return unlink($str);
        } elseif (is_dir($str)) {
            $scan = glob(rtrim($str, '/').'/*');
            foreach ($scan as $index => $path) {
                $this->clean($path);
            }
            chmod($str, 0777);

            return @rmdir($str);
        }
    }

    public function replace($path, $data)
    {
        if (file_exists($path)) {
            file_put_contents($path, $data);
        }
    }

    public function handle()
    {
        // Clean Config
        $this->clean(config_path('_fonts.php'));
        $this->replace(config_path('app.php'), file_get_contents(__DIR__.'/../../config/app.php'));
        $this->replace(config_path('database.php'), file_get_contents(__DIR__.'/../../config/database.php'));
        $this->clean(config_path('debugbar.php'));
        $this->clean(config_path('auth.php'));
        $this->clean(config_path('image.php'));
        $this->clean(config_path('pakka.php'));
        $this->clean(config_path('placeholders.php'));
        $this->clean(config_path('settings.php'));

        // Clean Helpers
        $this->clean(app_path('Helpers'));

        // Clean Providers
        $this->clean(app_path('Providers/HelperServiceProvider.php'));
        $this->clean(app_path('Providers/MacroServiceProvider.php'));

        // Clean Middleware
        $this->replace(app_path('Http/Middleware/Locale.php'), file_get_contents(__DIR__.'/../Http/Middleware/Locale.php'));
        $this->replace(app_path('Http/Middleware/Role.php'), file_get_contents(__DIR__.'/../Http/Middleware/Role.php'));
        $this->replace(app_path('Http/Middleware/VerifyCsrfToken.php'), file_get_contents(__DIR__.'/../Http/Middleware/VerifyCsrfToken.php'));
        $this->replace(app_path('Http/Middleware/CheckForMaintenanceMode.php'), file_get_contents(__DIR__.'/../Http/Middleware/CheckForMaintenanceMode.php'));
        // Clean Kernel
        $this->replace(app_path('Http/Kernel.php'), file_get_contents(__DIR__.'/../Http/Kernel/Kernel.php'));

        // Clean Seeder
        $this->clean(base_path('database/seeders/DatabaseSeeder.php'));

        // Clean Storage Assets
        $this->clean(storage_path('app/analytics'));
        $this->clean(storage_path('fonts'));

        // Clean Public Assets
        $this->clean(public_path('vendor/css'));
        $this->clean(public_path('vendor/js'));
        $this->clean(public_path('vendor/images'));
        $this->clean(public_path('vendor/fonts'));

        $this->comment('All Clean!');
    }
}
