<?php

namespace TheRealJanJanssens\Pakka\Commands;

use Illuminate\Console\Command;

class ShowTextCommand extends Command
{
    public $signature = 'show-text';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
