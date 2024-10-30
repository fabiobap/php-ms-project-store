<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): JsonResponse
    {
        return response()->json([
            'message' => 'API powered by Laravel v' . Application::VERSION . ' and PHP v' . PHP_VERSION
        ]);
    }
}
