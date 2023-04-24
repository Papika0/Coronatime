<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Countries extends Model
{
	use HasFactory, HasTranslations;

	protected $guarded = [];

	public $translatable = ['name'];

	public function stats()
	{
		return $this->hasOne(CountryStats::class, 'code', 'code');
	}
}
