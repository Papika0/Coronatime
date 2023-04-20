<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class RemoveUnverifiedUsers extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'users:remove-unverified';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$twoHoursAgo = Carbon::now()->subHours(2);

		User::where('email_verified_at', null)
			->where('created_at', '<', $twoHoursAgo)
			->delete();
	}
}
