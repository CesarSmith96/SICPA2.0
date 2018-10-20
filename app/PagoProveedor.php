<?php namespace SICPA;

use Illuminate\Database\Eloquent\Model;

class PagoProveedor extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_pagoproveedor';

    protected $primaryKey="pagop_id";
	protected $fillable = ['pagop_fecha','pagop_monto','pagop_banco','pagop_nope','comp_id','pagop_tipcambio'];
	public function comprobante(){
		return $this->belongsTo('SICPA\Comprobante','comp_id');
	}
}
