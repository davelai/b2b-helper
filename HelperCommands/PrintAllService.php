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

//-------- Total Services: 127 --------
//['ACG', 'AEL', 'AX', 'Airalo', 'B2BProduct', 'B2bOrder', 'B2rMedia', 'B2rMultiLang', 'B2rPackage', 'B2rProduct', 'BMGBooking', 'BMGData', 'BMGProductOption', 'BMGProduct', 'BMGProductService_old.php', 'BMG', 'Bcifop', 'BookingRule', 'Broadway', 'CKS', 'CalendarRule', 'Chimelong', 'CityTour', 'Coreworks', 'Ctrip', 'CustomLinc', 'DJB', 'E7Life', 'ERL', 'Edenred', 'Enjoyaus', 'Everland', 'ExcitingPenghu', 'ExperienceOz', 'Ezo', 'Fake', 'FargloryOceanPark', 'Fontrip', 'FunNow', 'GalaxyConnect', 'GlobalTix', 'GoodFellows', 'HIS', 'HKDL', 'HKOP', 'HKOPv2', 'HS', 'HanaTour', 'ITC', 'IVenture', 'Ibis', 'Ingresso', 'Inventory', 'JPH', 'JPHv2', 'JRKyushu', 'JejuMobile', 'JejuShinhwaWorld', 'K11', 'KKApi', 'LPG', 'LSCompany', 'Lihpao', 'Linktivity', 'LongHung', 'M12', 'MacauTower', 'MelcoCrown', 'Mohist', 'NP360', 'Nanta', 'Nextstory', 'Ocard', 'PeakTramways', 'Phantom', 'Playstory', 'PlusN', 'Prepia', 'REZIO', 'RWC', 'RWS', 'RailEurope', 'RedTable', 'Redeam', 'SANPU', 'SET', 'SHDL', 'SeoulPass', 'SeoulPassV2', 'SiteMinderFake', 'SiteMinder', 'SkiData', 'Skyroam', 'SmartInfini', 'Smartix', 'StarYouBon', 'SunWorld', 'Sunacctg', 'Systex', 'TFC', 'THSROTS', 'THSROTSv2', 'THSRTW', 'Tablenjoy', 'ThreeTGD', 'TicketGo', 'Ticketsuda', 'TourBMS', 'TourCMS', 'TripStore', 'Tripcarte', 'TsimTech', 'TurboJET', 'TwelveCM', 'USIMSA', 'UniveralStudio', 'VPass', 'Varitrip', 'Ventrata', 'VinWonder', 'Vocom', 'WBF', 'WeekN', 'Windbreak', 'Xpark', 'Xplori', 'Yanolja']
