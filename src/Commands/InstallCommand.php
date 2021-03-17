<?php

namespace TheRealJanJanssens\Pakka\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    public $signature = 'pakka-install';

    public $description = 'My command';

    public function clean($path){
        if(file_exists($path)){
            unlink($path);
        }
    }

    public function handle()
    {
        //remove some files
        Artisan::call('pakka-clean');
        $this->info('Application cleaned');

        //copy all files
        Artisan::call('vendor:publish --tag=pakka');
        $this->info('Copied all files');

        //migrate

        //clear cache
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        $this->info('Cleared Cache');

        $this->comment('All done!');
    }
}
