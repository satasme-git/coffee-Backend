<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    protected $table = 'foods';

	  public function orderFoods() {
		return $this->hasMany(OrderFoods::class, 'foods_id');
      }
      
      
}
