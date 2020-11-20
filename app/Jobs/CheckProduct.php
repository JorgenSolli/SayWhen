<?php

namespace App\Jobs;

use ReflectionClass;
use App\Models\Watcher;
use Illuminate\Bus\Queueable;
use App\Services\KomplettService;
use App\Services\StoreService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Watcher */
    private $watcher;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Watcher $watcher)
    {
        $this->watcher = $watcher;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $storeService = new StoreService($this->watcher->store, $this->watcher);
        $storeService->updateProduct();
    }
}
