<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CountriesController extends Controller
{
	public function show(): View
	{
		$stats = Countries::selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
		->first();
		return view('dashboard.worldwide', ['stats' => $stats]);
	}

	public function index(Request $request): View
	{
		$countryStats = Countries::filter($request)->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}
