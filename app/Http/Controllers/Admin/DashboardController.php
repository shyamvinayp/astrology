<?php

namespace App\Http\Controllers\Admin;

use App\Carrier;
use App\GovernmentAgency;
use App\ScamCenter;
use App\ScammerPhone;
use App\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function index()
	{
		/*$data['userCount'] = User::count();
        $data['scamCount'] = ScammerPhone::count();
        $data['scamTypeCount'] = Agent::count();
        $data['carrierCount'] = Carrier::count();
        $data['scamcenterCount'] = ScamCenter::count();
        $data['agencycontactCount'] = GovernmentAgency::count();*/
        $data = [];
		return view('admin.dashboard', $data);
	}

}
