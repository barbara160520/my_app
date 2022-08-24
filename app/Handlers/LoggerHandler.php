<?php

namespace App\Handlers;

use App\Services\{BuubleSortService, MemoryUsageService, QuickSortService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoggerHandler implements LoggerHandlerInterface
{
    public function handle()
    {
        $time_start = new \DateTime('now');
        Log::info('Начал работать в '. $time_start->format('d-m-Y H:i:s'));

        $array = [1, 2, 3, 5, 6 ,8 , 1, 12, 15, 18, 1,2 ,3 ,4, 6, 13, 15 , 17 ];

        $buubleSort= app(BuubleSortService::class)->sort($array);
        $quickSort= app(QuickSortService::class)->sort($array);

        echo 'Buuble: ';
        foreach ($buubleSort as $value){
            echo $value.' ';
        };
        echo '<br>Quick: ';
        foreach ($quickSort as $value){
            echo $value.' ';
        };

        $totalMemory = app(MemoryUsageService::class)->echo_memory_usage(memory_get_usage(true));
        $usedMemory = app(MemoryUsageService::class)->echo_memory_usage(memory_get_usage());

        Log::debug('Общая память, выделенная системой, включая неиспользуемые страницы: '.$totalMemory);
        Log::debug('Используемая память: '.$usedMemory);
        $time_end = new \DateTime('now');
        Log::info('Закончил работать в '. $time_end->format('d-m-Y H:i:s'));
    }
}
