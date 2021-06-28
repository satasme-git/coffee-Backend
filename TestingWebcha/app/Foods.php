<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Foods extends Model{
	protected $table = 'foods';
	
	public function category() {
		return $this->belongsTo('\App\Category::class');
  }
  
  public function subCategory() {
		return $this->belongsTo(\App\Subcategory::class, 'id');
	}
}
