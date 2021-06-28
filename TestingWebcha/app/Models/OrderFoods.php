<?php

namespace App\Models;
use App\Models\Orders;
use App\Models\OrderFoods;
use App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFoods extends Model
{
    protected $table = 'order_foods';
	
	public function order() {
		return $this->belongsTo(Orders::class, 'orders_id');
    }
    
    public function foods() {
		return $this->belongsTo(Foods::class, 'foods_id');
	}


}
