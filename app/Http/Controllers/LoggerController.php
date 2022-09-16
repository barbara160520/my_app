<?php

namespace App\Http\Controllers;

use App\Handlers\LoggerHandler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation;

class LoggerController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(LoggerHandler $handler): Application|Factory|View
    {
         return view('logger',[
             'data' => $handler->handle()
         ]);

    }
}
