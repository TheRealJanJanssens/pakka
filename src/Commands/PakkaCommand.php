<?php

namespace TheRealJanJanssens\Pakka\Commands;

use Illuminate\Console\Command;

class PakkaCommand extends Command
{
    public $signature = 'pakka';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
