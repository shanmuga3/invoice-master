<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CurrencyConversion;

class Invoice extends Model
{
	use CurrencyConversion;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
	
    public function invoice_items()
    {
    	return $this->hasMany('App\Models\InvoiceItems');
    }

    public function invoice_taxes()
    {
    	return $this->hasMany('App\Models\InvoiceTax');
    }

    public function getDiscountSubTotalAttribute()
    {
        return $this->sub_total - $this->discount;
    }
}
