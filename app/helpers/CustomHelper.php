<?php

namespace App\helpers;
use App\supplier_ledger;
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

	public function checkvoucherfromtop($id = 0){
		$voucher = supplier_ledger::where('balance','!=', 0)->where('type','=','payment');
		if($id != 0){
			$voucher->where('voucher_id','!=',$id);
		}
		$check = $voucher->orderBy('id', 'asc')->first();
		return $this->checkvoucher($check);
	}

	public function checkvoucher($voucher){
		$check = supplier_ledger::where('voucher_id','=',$voucher->voucher_id)->orderBy('id', 'desc')->first();
		if($check->balance == 0){
			$this->checkvoucherfromtop($check->voucher_id);
		}else{
			return $check;
		}
	}
}
?>