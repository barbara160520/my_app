<?php

namespace App\Services;

class MemoryUsageService
{
    function echo_memory_usage($mem_usage)
    {
        if ($mem_usage < 1024)
            return $mem_usage." байт";
        elseif ($mem_usage < 1048576)
            return round($mem_usage/1024,2)." Кб";
        else
            return round($mem_usage/1048576,2)." Мб";
    }
}
