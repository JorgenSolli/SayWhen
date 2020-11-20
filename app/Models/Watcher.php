<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store',
        'email',
        'product_name',
        'found',
        'last_scan',
        'stock_status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_scan',
    ];
}
