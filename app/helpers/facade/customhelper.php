<?php 
namespace App\helpers\facade;

use Illuminate\Support\Facades\Facade;

class customhelper extends Facade{
	public static function getFacadeAccessor(){
		return 'CH';
	}
}