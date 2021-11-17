<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = array('name','user_id');
    protected $appends = ['customer_ids'];


    /**
     * The customers that belong to the user.
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function getcustomerIdsAttribute()
    {
        return $this->customers->pluck('id');
    }

}
