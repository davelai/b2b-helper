<?php

namespace App\Console\Commands\__temp;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PrintAllService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:printAllService';

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

    public function handle()
    {
        $files = File::files(app_path('Services'));

        $services = [];
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $serviceName = preg_replace('/Service\.php$/', '', $filename);
            $this->info($serviceName);
            $services[] = "'" . $serviceName . "'";
        }

        $this->line('-------- Total Services: ' . count($services) . ' --------');

        $this->line('[' . implode(', ', $services) . ']');
    }
}
