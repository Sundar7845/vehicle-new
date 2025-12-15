<?php

namespace App\Http\Controllers\Backend\Site;

use App\Http\Controllers\Controller;
use App\Models\AdminSite;
use App\Models\Party;
use App\Models\Site;
use App\Models\User;
use App\Models\WalkinVehicle;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{
    function site($id = null)
    {
        $roleId = Auth::user()->role_id;

        // If ID is NOT provided → show default site list
        if ($id === null) {
            if ($roleId == 3) {
                // Role 3: all active sites
                $previousUrl = url()->previous();
                $id = basename(parse_url($previousUrl, PHP_URL_PATH));
                $userId = AdminSite::where('site_id', $id)->value('user_id');
                $adminSiteIds = AdminSite::where('user_id', $userId)
                    ->pluck('site_id')
                    ->toArray();

                $sites = Site::whereIn('id', $adminSiteIds)
                    ->where('is_active', 1)
                    ->get();
            } else {
                // Other roles: only assigned sites
                $sites = Auth::user()
                    ->sites()
                    ->where('is_active', 1)
                    ->get();
            }

            return view('backend.site', compact('sites'));
        }

        // If ID IS provided
        if ($roleId == 3) {
            $adminSiteIds = AdminSite::where('user_id', $id)
                ->pluck('site_id')
                ->toArray();

            $sites = Site::whereIn('id', $adminSiteIds)
                ->where('is_active', 1)
                ->get();
        } else {
            $sites = Auth::user()
                ->sites()
                ->where('is_active', 1)
                ->where('sites.id', $id)
                ->get();
        }
        return view('backend.site', compact('sites'));
    }

    public function otp(Request $request, $id)
    {
        try {
            // If AJAX request, return DataTable data
            if ($request->ajax()) {
                $user = User::where('site_id', $id)->value('id');

                if (!$user) {
                    return response()->json([
                        'error' => 'User not found for this site.'
                    ], 404);
                }

                $data = WalkinVehicle::where('user_id', $user)
                    ->whereDate('walkin_vehicles.in_time', Carbon::today())
                    ->Join('units', 'units.id', '=', 'walkin_vehicles.unit_id')
                    ->select([
                        'walkin_vehicles.*',
                        'units.unit_name' // 👈 alias
                    ]);
                // $data = WalkinVehicle::where('user_id', $user)->whereDate('created_at', Carbon::today());

                // Optional: filter by date if provided
                if ($request->has('date') && !empty($request->date)) {
                    $data->whereDate('created_at', $request->date);
                }

                if ($request->has('party') && !empty($request->party)) {
                    $data->where('party_id', $request->party);
                }

                return DataTables::of($data)
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d-m-Y');
                    })
                    ->editColumn('in_time', function ($row) {
                        return $row->in_time
                            ? Carbon::parse($row->in_time)->format('h:i A')
                            : '';
                    })
                    ->editColumn('out_time', function ($row) {
                        return $row->out_time
                            ? Carbon::parse($row->out_time)->format('h:i A')
                            : '';
                    })
                    ->editColumn('units', function ($row) {
                        return $row->unit_name;
                    })
                    ->make(true);
            }

            // Otherwise load the view
            // SELECTIVE VISIBILITY: Ensure admin has access to this site
            $roleId = Auth::user()->role_id;

            if ($roleId == 3) {
                // Role 3: can access any active site
                $site = Site::where('id', $id)
                    ->where('is_active', 1)
                    ->first();
            } else {
                // Other roles: only assigned sites
                $site = Auth::user()
                    ->sites()
                    ->where('is_active', 1)
                    ->where('sites.id', $id)
                    ->first();
            }

            if (!$site) {
                return redirect()->back()->with('error', 'Site not found or access denied.');
            }

            $parties = Party::where('site_id', $site->id)->get();
            // Step 1: Get all users for this site
            $siteUserIds = User::where('site_id', $id)->pluck('id')->toArray();

            if (empty($siteUserIds)) {
                $display = "0 unit";
            } else {
                // Step 2: Get all units for these users
                $units = WalkinVehicle::whereIn('user_id', $siteUserIds)
                    ->whereDate('walkin_vehicles.in_time', Carbon::today())
                    ->join('units', 'units.id', '=', 'walkin_vehicles.unit_id')
                    ->pluck('units.unit_name');

                // Step 3: Calculate total numeric units
                $total = $units->sum(function ($item) {
                    return (int) filter_var($item, FILTER_SANITIZE_NUMBER_INT);
                });

                // Step 4: Display total
                $display = $total . ' unit';
            }

            return view('backend.otp', compact('site', 'parties', 'display'));
        } catch (Exception $e) {
            // dd($e->getMessage());
            // Log the error for debugging
            Log::error('Error fetching OTP data: ' . $e->getMessage());

            // Return JSON for AJAX or redirect for normal requests
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Something went wrong while fetching data.'
                ], 500);
            } else {
                return redirect()->back()->with('error', 'Something went wrong while loading the page.');
            }
        }
    }


    // Fetch OTPs with JOIN query
    public function getOtps($id)
    {
        $otps = User::where('role_id', 2)
            ->where('site_id', $id)
            ->first(); // fetch only one record

        return response()->json($otps);
    }

    // Refresh single OTP
    public function refreshOtp($userId)
    {
        $otp = rand(1000, 9999);

        User::where('id', $userId)->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinute(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
