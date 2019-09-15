<?php

namespace App\helpers;

class CustomHelper{

	public function convert_box($qty,$pieces_box,$meter_box){
		$boxes = intval($qty / $pieces_box);
		$pieces = $qty - ($boxes * $pieces_box);
		$meter = ($meter_box / $pieces_box) * $qty;

		$obj = array();
		$obj['boxes'] = $boxes;
		$obj['pieces'] = $pieces;
		$obj['meter'] = $meter;
		return $obj;
	}
}
?>