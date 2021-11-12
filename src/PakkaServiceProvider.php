<?php

namespace TheRealJanJanssens\Pakka;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TheRealJanJanssens\Pakka\Commands\CleanCommand;
use TheRealJanJanssens\Pakka\Commands\InstallCommand;
use TheRealJanJanssens\Pakka\Commands\UserMakeCommand;

class PakkaServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //php artisan vendor:publish --tag=pakka
        $this->publishes([
            // Config
            __DIR__.'/../config/_fonts.php' => config_path('_fonts.php'),
            __DIR__.'/../config/app.php' => config_path('app.php'),
            __DIR__.'/../config/database.php' => config_path('database.php'),
            __DIR__.'/../config/debugbar.php' => config_path('debugbar.php'),
            __DIR__.'/../config/cache.php' => config_path('cache.php'),
            __DIR__.'/../config/auth.php' => config_path('auth.php'),
            __DIR__.'/../config/image.php' => config_path('image.php'),
            __DIR__.'/../config/maps.php' => config_path('maps.php'),
            __DIR__.'/../config/pakka.php' => config_path('pakka.php'),
            __DIR__.'/../config/placeholders.php' => config_path('placeholders.php'),
            __DIR__.'/../config/settings.php' => config_path('settings.php'),

            // NPM json
            __DIR__.'/../resources/dev/package.json' => base_path('package.json'),

            // Webpack Mix
             __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

            // Helpers
            //__DIR__.'/../src/Helpers' => app_path('Helpers'),

            // Providers
            __DIR__.'/../src/Providers/HelperServiceProvider.php' => app_path('Providers/HelperServiceProvider.php'),
            __DIR__.'/../src/Providers/MacroServiceProvider.php' => app_path('Providers/MacroServiceProvider.php'),

            // Middleware
            __DIR__.'/../src/Http/Middleware/Locale.php' => app_path('Http/Middleware/Locale.php'),
            __DIR__.'/../src/Http/Middleware/Role.php' => app_path('Http/Middleware/Role.php'),
            __DIR__.'/../src/Http/Middleware/VerifyCsrfToken.php' => app_path('Http/Middleware/VerifyCsrfToken.php'),
            __DIR__.'/../src/Http/Middleware/CheckForMaintenanceMode.php' => app_path('Http/Middleware/CheckForMaintenanceMode.php'),

            // Kernel
            __DIR__.'/../src/Http/Kernel/Kernel.php' => app_path('Http/Kernel.php'),

            // Seeders
            __DIR__.'/../database/seeders/DatabaseSeeder.php' => base_path('database/seeders/DatabaseSeeder.php'),

            //Auth
            //__DIR__.'/../src/Http/Controllers/Auth' => app_path('Http/Controllers/Auth'),

            // Storage Assets
            __DIR__.'/../storage/analytics' => storage_path('app/analytics'),
            __DIR__.'/../storage/fonts' => storage_path('fonts'),

            // Public Assets
            __DIR__.'/../resources/dist/css' => public_path('vendor/css'),
            __DIR__.'/../resources/dist/js' => public_path('vendor/js'),
            __DIR__.'/../resources/dist/images' => public_path('vendor/images'),
            __DIR__.'/../resources/dist/fonts' => public_path('vendor/fonts'),
        ], 'pakka');

        // $this->publishes([
        //     // Composer.json for pakka dev
        //     __DIR__.'/../resources/dev/composer.json' =>  public_path('../composer.json'),

        //     // Webpack Mix
        //     __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

        //     // Dev Assets
        //     __DIR__.'/../resources/js' => resource_path('pakka/js'),
        //     __DIR__.'/../resources/sass' => resource_path('pakka/sass'),

        // ], 'pakka-dev');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pakka')
            ->hasViews()
            ->hasConfigFile()
            ->hasTranslations()
            ->hasRoute('web')
            ->hasMigrations([
                'add_permission_to_section_items_table',
                'create_attribute_inputs_table',
                'create_attribute_options_table',
                'create_attribute_values_table',
                'create_bookings_table',
                'create_cart_services_table',
                'create_collection_conditions_table',
                'create_collection_sets_table',
                'create_collections_table',
                'create_components_table',
                'create_coupons_table',
                'create_coupons_table',
                'create_forms_table',
                'create_images_table',
                'create_invoice_details_table',
                'create_invoice_items_table',
                'create_invoice_presets_table',
                'create_invoices_table',
                'create_items_table',
                'create_languages_table',
                'create_menu_items_table',
                'create_menus_table',
                'create_order_details_table',
                'create_order_documents_table',
                'create_order_items_table',
                'create_order_payments_table',
                'create_order_shipments_table',
                'create_orders_table',
                'create_pages_table',
                'create_password_resets_table',
                'create_products_table',
                'create_projects_table',
                'create_provider_schedules_table',
                'create_providers_table',
                'create_section_items_table',
                'create_sections_table',
                'create_service_assignments_table',
                'create_services_table',
                'create_settings_table',
                'create_shipment_conditions_table',
                'create_shipment_options_table',
                'create_stocks_table',
                'create_task_comments_table',
                'create_task_groups_table',
                'create_tasks_table',
                'create_templates_table',
                'create_translations_table',
                'create_user_details_table',
                'create_users_table',
                'create_variant_options_table',
                'create_variant_values_table',
                'create_variants_table',
            ])
            ->hasCommands([
                InstallCommand::class,
                CleanCommand::class,
                UserMakeCommand::class,
            ]);
    }
}
