<?php

namespace App\Console\Commands;

use App\Jobs\CheckProduct;
use App\Models\Watcher;
use Illuminate\Console\Command;

class ScanProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $watchers = Watcher::where('found', 0)->get();
        foreach ($watchers as $watcher) {
            dispatch(new CheckProduct($watcher));
        }
    }
}
