<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: Start
 * Date: 2/27/2018
 * Time: 6:17 AM
 */
class Shop extends Model{
    protected $fillable = [
        'shop_id',
        'shop_name',
        'description',
        'contact_no',
        'email',
        'resident_no',
        'street',
        'city',
        'country',
        'zip_code',
        'username',
        'created_at'
    ];
    protected $table ="shop";
    protected $primaryKey = 'shop_id';

    public function getShopId(){
        $shop = Shop::where('username', Session::get('username'))->first();
        $shopId = $shop->shop_id;
        return $shopId;
    }
}