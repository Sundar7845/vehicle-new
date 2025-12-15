<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\Units;
use App\Models\VehicleType;
use App\Models\WalkinVehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    function dashboard(Request $request)
    {
        if ($request->ajax()) {
            $walkinvehicles = WalkinVehicle::select('walkin_vehicles.*', 'vehicle_types.vechicle_type')
                ->join('vehicle_types', 'vehicle_types.id', 'walkin_vehicles.vehicle_type_id')
                ->whereNull('walkin_vehicles.out_time')
                ->where('user_id', auth()->user()->id)
                ->get();

            return DataTables::of($walkinvehicles)
                ->addIndexColumn()
                ->addColumn('in_time', function ($row) {
                    $inTime = Carbon::parse($row->in_time); // parse string to Carbon
                    return '<div>' . $inTime->format('M d, Y') . '</div>
                            <div>' . $inTime->format('h:i:s a') . '</div>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="bg-[#ED2401] cursor-pointer text-white px-3 py-1 rounded text-xs"
                            onclick="vehicleOut(' . $row->id . ')">Out</button>';
                })
                ->rawColumns(['in_time', 'action'])
                ->make(true);
        }

        return view('frontend.dashboard');
    }

    function vehicle()
    {
        $vehicletypes = VehicleType::get();
        $units = Units::get();
        $parties = Party::where('site_id', Auth::user()->site_id)->get(); // Assuming site_id is 1 for demo
        return view('frontend.vehicle', compact('vehicletypes', 'units', 'parties'));
    }

    function vehiclestore(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|min:8|max:10',
        ]);

        // Check if vehicle is already in (no out_time)
        $existing = WalkinVehicle::where('vehicle_number', $request->vehicle_number)
            ->whereNull('out_time')
            ->first();

        if ($existing) {
            // Vehicle already in, show Toastr error
            return redirect()->back()->with('error', 'This vehicle is already parked. Please check out first.');
        }

        // Process the vehicle number as needed
        WalkinVehicle::Create([
            'user_id' => auth()->user()->id,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_type_id' => $request->vehicle_type,
            'party_id' => $request->party_name,
            'unit_id' => $request->unit_id,
            'in_time' => now(),
        ]);

        return redirect()->route('frontend.dashboard')->with('success', 'Vehicle information submitted successfully.');
    }

    public function fetchDetails($vehicleNumber)
    {
        $vehicle = WalkinVehicle::where('vehicle_number', $vehicleNumber)->first();

        if ($vehicle) {
            return response()->json([
                'status' => 'success',
                'vehicle_number' => $vehicle->vehicle_number,
                'vehicle_type_id' => $vehicle->vehicle_type_id,
                'party_id' => $vehicle->party_id,
                'unit_id' => $vehicle->unit_id
            ]);
        }

        return response()->json(['status' => 'not_found']);
    }

    public function fetchDefaultUnit($vehicleTypeId)
    {
        $unit = Units::where('id', $vehicleTypeId)->first(); // fetch default unit

        if ($unit) {
            return response()->json([
                'status' => 'success',
                'unit_id' => $unit->id
            ]);
        }

        return response()->json(['status' => 'not_found']);
    }

    public function vehicleOut($id)
    {
        $vehicle = WalkinVehicle::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found or unauthorized.',
            ], 404);
        }

        // Calculate exact spent time
        $inTime = Carbon::parse($vehicle->in_time);
        $outTime = Carbon::now();

        $diff = $outTime->diff($inTime);

        // Format as HH:MM:SS
        $spentTime = sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
        // Update checkout time or status
        $vehicle->update([
            'out_time' => $outTime,
            'spent_time' => $spentTime
        ]);

        return response()->json([
            'message' => 'Vehicle checked out successfully.',
        ]);
    }
}
