<?php

namespace App\Jobs;

use ReflectionClass;
use App\Models\Watcher;
use Illuminate\Bus\Queueable;
use App\Services\KomplettService;
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
        $stores = config('stores.list');
        $store = $stores[$this->watcher->store] ?? false;
        $storeDefinition = config('stores.definitions')[$this->watcher->store];

        if (!$store) {
            return;
        }

        $ref = new ReflectionClass($storeDefinition['service']);

        /** @var KomplettService */
        $storeService = $ref->newInstanceArgs([$storeDefinition, $this->watcher]);
        $storeService->updateProductStatus();
    }
}
