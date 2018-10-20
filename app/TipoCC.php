<?php namespace SICPA;

use Illuminate\Database\Eloquent\Model;

class TipoCC extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't_tipocc';

    protected $primaryKey="tcc_id";
	protected $fillable = ['tcc_desc'];
	
	public function ieexternos(){
		return $this->hasMany('SICPA\IEExterno');
	}
}
