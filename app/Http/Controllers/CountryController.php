<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CountryController extends Controller
{
	public function show(): View
	{
		$stats = Country::selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
		->first();
		return view('dashboard.worldwide', ['stats' => $stats]);
	}

	public function index(Request $request): View
	{
		$countryStats = Country::filter($request)->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}
