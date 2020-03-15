<?php

namespace App\Traits;

trait CurrencyConversion
{
	public function getCurrencyCodeAttribute()
	{
		return "INR";
	}

	public function getCurrencySymbolAttribute()
	{
		return html_entity_decode("₹​");
	}

}