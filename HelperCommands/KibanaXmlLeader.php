<?php

function kibanaXmlToString()
{
    $failCount = 0;
    $file = base_path('app/Console/Commands/__temp/shiji.csv');
    $storeCsv = base_path('app/Console/Commands/__temp/shiji_generate.csv');
    $storeHandle = fopen($storeCsv, 'a');
    if (($handle = fopen($file, 'r')) !== false) {
        while (($row = fgetcsv($handle, 10000000, ',')) !== false) {
            $cleanedLog = $row[2];
            $cleanedLog = str_replace('\"', '"', $cleanedLog);
            $cleanedLog = str_replace('\\', '', $cleanedLog);
            $cleanedLog = str_replace('""', '"', $cleanedLog);

            while ($cleanedLog != '' && $cleanedLog[0] !== '<') {
                $cleanedLog = substr($cleanedLog, 1);
            }

            while ($cleanedLog != '' && substr($cleanedLog, -1) !== '>') {
                $cleanedLog = substr($cleanedLog, 0, -1);
            }

            try {
                simplexml_load_string($cleanedLog);
            } catch (\Exception $e) {
                $failCount++;
//                    dd($cleanedLog);
            }

            fputcsv($storeHandle, [$cleanedLog]);
        }
        fclose($handle);
    }

    $this->line('fail count: ' . $failCount);
}
