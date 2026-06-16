<?php

namespace App\Http\Controllers\Our;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('our.dashboard');
    }
}
