<?php
/**
 * Created by PhpStorm.
 * User: Start
 * Date: 5/5/2018
 * Time: 9:10 AM
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];
    protected $table ="customer";
    protected $primaryKey = 'customer_id';



}