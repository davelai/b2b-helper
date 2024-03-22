<?php

namespace App\Console\Commands\__temp;

use App\Console\Commands\mixed;
use App\HttpClient\ShijiClient;
use App\Models\SystemSetting;
use App\Responses\OrderFileList\OrderFileList;
use App\Services\GalaxyConnectService;
use App\Services\RWCService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use OrderInfoHelper;
use Tests\FakeOrder\FakeOrder;

class RunTestCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:testCheck';

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
     * @return mixed
     */
    public function handle()
    {
        $dbHost = env('DB_HOST');
        if ($dbHost !== 'kkday-b2b-api-psgl') {
            dd('error, db host: ' . $dbHost);
        }

        dd('success, db host: ' . $dbHost);
    }
}
