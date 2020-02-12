<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxTypes extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
	/**
     * Status Of the Admin
     *
     * @var array
     */
    protected $status = ['Inactive','Active'];

    /**
     * Store the encrypted password to table.
     *
     */
    public function scopeActiveOnly($query)
    {
        return $query->where('status',1);
    }

    /**
     * Get Status Text
     *
     */
    public function getStatusTextAttribute()
    {
        $status = $this->attributes['status'];
        return $this->status[$status];
    }
}
