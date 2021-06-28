<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model{
	protected $table = 'category';

  public function foods() {
    return $this->hasMany(\App\Foods::class, 'category');
  }
}
