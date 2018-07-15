<?php

namespace Handytravelers\Console\Commands;

use Handytravelers\Components\Homes\Models\Home;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateHomesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homes:update {--scout}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates homes table';

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
     * @return mixed
     */
    public function handle()
    {
        Home::withoutSyncingToSearch(function() {
            Home::orderBy('id')->chunk(100, function ($homes) {
                foreach ($homes as $home) {
                    $home->uuid = (string) Str::uuid();
                    $home->save();
                }
            }
            );
        });
    }
}
