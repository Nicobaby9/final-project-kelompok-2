<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roles:0']);
    }

    public function index()
    {
        $logs = Activity::orderBy('created_at', 'desc')->get();

        return $logs;
    }
}
