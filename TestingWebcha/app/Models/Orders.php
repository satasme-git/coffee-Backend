<?php

namespace App\Models;
use App\Models\Orders;
use App\Models\OrderFoods;
use App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';

	  public function orderFoods() {
		return $this->hasMany(OrderFoods::class, 'orders_id');
	  }

	  public function users() {
		return $this->belongsTo(Users::class, 'users_id');
	}
	  
}
