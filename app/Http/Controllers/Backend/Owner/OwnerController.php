<?php

namespace App\Http\Controllers\Backend\Owner;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    function kill()
    {
        $settings = Setting::first();
        return view('backend.owner.kill', compact('settings'));
    }

    // Update Kill Switch value via AJAX
    public function updateKill(Request $request)
    {
        $request->validate([
            'kill' => 'required|in:0,1'
        ]);

        $settings = Setting::first(); // assuming single settings row

        $settings->kill = $request->kill;
        $settings->save();

        return response()->json([
            'success' => true
        ]);
    }
}
