<?php

namespace App\Http\Controllers;

use App\Mail\NewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function show()
    {
        return view('report');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:4', 'max:15'],
        ]);

        return redirect()->route('report');
    }
}
