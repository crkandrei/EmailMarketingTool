<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'group_id'];
    protected $table = 'customer_group';

    /**
     * Get the customers.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    /**
     * Get the groups.
     */
    public function groups()
    {
        return $this->hasMany(Group::class, 'id', 'group_id');
    }

}
