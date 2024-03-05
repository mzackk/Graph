<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function showGraph()
    {
        $userCounts = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                          ->whereYear('created_at', date('Y'))
                          ->groupBy('month')
                          ->orderBy('month')
                          ->get();

        $labels = $userCounts->pluck('month')->toArray();
        $data = $userCounts->pluck('count')->toArray();

        return view('graphs', compact('labels', 'data'));
    }
}
