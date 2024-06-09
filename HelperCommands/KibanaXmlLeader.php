<?php

use App\Http\Controllers\Api\v1\B2bOrderController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

function shijiToApi()
{
    $storeCsv = base_path('app/Console/Commands/__temp/shiji_generate.csv');
    if (($handle = fopen($storeCsv, 'r')) !== false) {
        while (($row = fgetcsv($handle, 10000000, ',')) !== false) {
            $client = new Client();

            // 發送 GET 請求到自己的 API 路由
            // content type: xml
            $response = $client->post('http://0.0.0.0:8000/api/v1/b2bCallback/Shiji/aoeuaeou', [
                'headers' => [
                    'Content-Type' => 'application/xml',
                ],
                'body' => $row[0],
            ]);

            dd($response->getBody()->getContents(), 99);
        }
        fclose($handle);
    }
}


function shijiToController()
{
    $storeCsv = base_path('app/Console/Commands/__temp/shiji_generate.csv');
    $b2bOrderController = app(B2bOrderController::class);

    if (($handle = fopen($storeCsv, 'r')) !== false) {
        while (($row = fgetcsv($handle, 10000000, ',')) !== false) {
            // 建立一個新的 Request 對象
            $request = Request::create('/api/v1/b2bCallback/Shiji', 'POST', [], [], [], [], $row[0]);

            // 設置 headers
            $request->headers->set('Content-Type', 'application/xml');
            $request->service = 'Shiji';

            // 呼叫 B2bOrderController 的 callback 方法
            $response = $b2bOrderController->callback($request, 'Shiji', 'aoeuaeou');

            dd($response);
        }
        fclose($handle);
    }
}
