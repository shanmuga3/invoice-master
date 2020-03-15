<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CurrencyConversion;

class InvoiceItems extends Model
{
    use CurrencyConversion;
}
