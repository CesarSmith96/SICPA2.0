<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAdicionalGuia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
	public function up()
	{
		Schema::create('t_adicionalguia', function(Blueprint $table)
		{
			$table->increments('adig_id');
			$table->integer('mtras_id')->unsigned();
			$table->string('adig_transprog');
			$table->decimal('adig_pbruto',12,2);
			$table->string('adig_nbulto');
			$table->string('adig_mtrasl');//modalidad traslado
			$table->date('adig_ftrasl');
			$table->string('adig_doctrans');
			$table->string('adig_tdoctrans');
			$table->string('adig_rztrans');
			$table->string('adig_nroplaca');
			$table->string('adig_doccond');
			$table->string('adig_tdoccond');
			$table->string('adig_paispart');
			$table->integer('dpto_idpart')->unsigned();
			$table->integer('prov_idpart')->unsigned();
			$table->integer('dist_idpart')->unsigned();
			$table->string('adig_dirpart');
			$table->string('adig_paislleg');
			$table->integer('dpto_idlleg')->unsigned();
			$table->integer('prov_idlleg')->unsigned();
			$table->integer('dist_idlleg')->unsigned();
			$table->string('adig_dirlleg');
			$table->string('adig_ncontenedor');
			$table->string('adig_codpuerto');
			$table->integer('uni_id')->unsigned();
			$table->integer('comp_id')->unsigned();
			$table->foreign('uni_id')->references('uni_id')->on('t_unidad');
			$table->foreign('comp_id')->references('comp_id')->on('t_comprobante');
			$table->foreign('mtras_id')->references('mtras_id')->on('t_motivotraslado');
			$table->foreign('dpto_idpart')->references('dpto_id')->on('t_departamento');
			$table->foreign('prov_idpart')->references('prov_id')->on('t_provincia');
			$table->foreign('dist_idpart')->references('dist_id')->on('t_distrito');
			$table->foreign('dpto_idlleg')->references('dpto_id')->on('t_departamento');
			$table->foreign('prov_idlleg')->references('prov_id')->on('t_provincia');
			$table->foreign('dist_idlleg')->references('dist_id')->on('t_distrito');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_adicionalguia');
	}

}
