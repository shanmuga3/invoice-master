<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class Admin extends Authenticatable
{
   use Notifiable,LaravelEntrustUserTrait;

    protected $guard = 'admin';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

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
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

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

    /**
     * Get Role Name
     *
     */
    public function getRoleNameAttribute()
    {
        $roles = $this->roles()->first();
        return $roles->name;
    }
}