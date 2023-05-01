<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_setLanguage_changes_locale_and_session_and_redirects_back()
	{
		$locale = 'ka';
		$response = $this->get(route('set.locale', $locale));

		$this->assertEquals($locale, app()->getLocale());
		$this->assertEquals($locale, session('locale'));

		$response->assertRedirect();
	}
}
