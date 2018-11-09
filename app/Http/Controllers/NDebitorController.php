<?php namespace SICPA\Http\Controllers;

use SICPA\NotaCredito;
use SICPA\CompraNCredito;
use SICPA\Comprobante;
use SICPA\DetalleComprobante;
use SICPA\Operacion;
use SICPA\TipoComprobante;
use SICPA\TipoComprobanteInc;
use SICPA\TipoOperacion;
use SICPA\Entidad;
use SICPA\Producto;
use SICPA\Inventario;
use SICPA\Conversion;
use SICPA\Vendedor;
use SICPA\Http\Requests\CrearNotaCreditoEmitidaRequest;
use SICPA\Http\Requests\EditarNotaCreditoEmitidaRequest;
use SICPA\Http\Requests\EditarNotaDebitoEmitidaRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NDebitorController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$comprobantes = Comprobante::join('t_operacion','t_operacion.comp_id','=','t_comprobante.comp_id')->select('t_comprobante.*')->where('t_operacion.tope_id','=','9')->where('t_comprobante.comp_id','<>','1')->orderBy('comp_fecha','desc')->orderBy('comp_nro','desc')->get();
		$vendedores = Vendedor::orderBy('vend_nom','asc')->get();
		$entidades = Entidad::where('tent_id','1')->where('ent_id','<>','1')->orderBy('ent_rz','asc')->get(); // tipo cliente
		$tipocomprobanteincs = TipoComprobanteInc::where('tcomp_id',4)->where('tcompinc_cod','<>','05')->where('tcompinc_cod','<>','08')->where('tcompinc_cod','<>','09')->get(); 
		// 4 Nota de Debito
		return view('ndebitor.mostrar',['comprobantes'=> $comprobantes,'tipocomprobanteincs'=> $tipocomprobanteincs,'entidades'=> $entidades,'vendedores'=> $vendedores]);
	}

	public function postIndex(Request $request)
	{
		$comp_nro = strtoupper($request->get('comp_nro'));
		$comp_fecha_ini = strtoupper($request->get('comp_fecha_ini'));
		$comp_fecha_fin = strtoupper($request->get('comp_fecha_fin'));
		//$comp_guia = strtoupper($request->get('comp_guia'));
		$tcompinc_id = strtoupper($request->get('tcompinc_id'));
		$comp_moneda = strtoupper($request->get('comp_moneda'));
		$tcomp_id = strtoupper($request->get('tcomp_id'));
		$ent_id = strtoupper($request->get('ent_id'));
		$vend_id = strtoupper($request->get('vend_id'));
		$igv = strtoupper($request->get('igv'));	

		$comprobantes = Comprobante::join('t_operacion','t_operacion.comp_id','=','t_comprobante.comp_id')->select('t_comprobante.*')->where('t_operacion.tope_id','=','5')->where('t_comprobante.comp_id','<>','1')->where('comp_nro','like','%'.$comp_nro.'%');

		/*if($comp_cond != "0")
		{
			$comprobantes = $comprobantes->where('comp_cond','=',$comp_cond);
		}*/
		if($comp_moneda != "0")
		{
			$comprobantes = $comprobantes->where('comp_moneda','=',$comp_moneda);
		}
		if($comp_fecha_ini != "")
		{
			$comprobantes = $comprobantes->where('comp_fecha','>=',$comp_fecha_ini);
		}
		if($comp_fecha_fin != "")
		{
			$comprobantes = $comprobantes->where('comp_fecha','<=',$comp_fecha_fin);
		}
		if($tcompinc_id != "0")
		{
			$comprobantes = $comprobantes->where('tcompinc_id','=',$tcompinc_id);
		}
		if($ent_id != "0")
		{
			$comprobantes = $comprobantes->where('ent_id','=',$ent_id);
		}
		if($vend_id != "0")
		{
			$comprobantes = $comprobantes->where('vend_id','=',$vend_id);
		}
		if($igv=="C")
		{
			$comprobantes = $comprobantes->where('comp_igv','>','0');
		}
		if($igv=="S")
		{
			$comprobantes = $comprobantes->where('comp_igv','=','0');
		}
		
		$comprobantes=$comprobantes->orderBy('comp_fecha','desc')->orderBy('comp_nro','desc')->get();
		$entidades = Entidad::where('tent_id','1')->where('ent_id','<>','1')->orderBy('ent_rz','asc')->get(); // tipo cliente
		//$tipocomprobantes = TipoComprobante::all();
		$tipocomprobanteincs = TipoComprobanteInc::where('tcomp_id',4)->where('tcompinc_cod','<>','05')->where('tcompinc_cod','<>','08')->where('tcompinc_cod','<>','09')->get();
		$vendedores = Vendedor::orderBy('vend_nom','asc')->get();

		if(Input::get('exportarxls'))
			$comprobantes=Comprobante::join('t_operacion','t_operacion.comp_id','=','t_comprobante.comp_id')->select('t_comprobante.*')->where('t_operacion.tope_id','=','5')->where('t_comprobante.comp_id','<>','1')->orderBy('comp_fecha','desc')->orderBy('comp_nro','desc')->get();
			return view('reporte.notacreditoemitida',['comprobantes'=> $comprobantes,'tipocomprobanteincs'=> $tipocomprobanteincs,'entidades'=> $entidades,'vendedores'=> $vendedores]);
		return view('notacreditoemitida.mostrar',['comprobantes'=> $comprobantes,'tipocomprobanteincs'=> $tipocomprobanteincs,'entidades'=> $entidades,'vendedores'=> $vendedores]);
	}

	public function getCrear(Request $request)
	{
		
		$comp_id=$request->get('comp_id');
		$comprobante = Comprobante::find($comp_id);
		$entidades = Entidad::where('tent_id','1')->where('ent_id','<>','1')->orderBy('ent_rz','asc')->get(); // tipo cliente

		$tipocomprobanteincs = TipoComprobanteInc::where('tcomp_id',4)->where('tcompinc_cod','<>','05')->where('tcompinc_cod','<>','08')->where('tcompinc_cod','<>','09')->get();
		$vendedores = Vendedor::orderBy('vend_nom','asc')->get();
		return view('ndebitor.crear',['tipocomprobanteincs'=> $tipocomprobanteincs,'entidades'=> $entidades,'vendedores'=> $vendedores,'comprobante'=> $comprobante]);
		
	}

	public function postCrear(CrearNotaCreditoEmitidaRequest $request)
	{
		$tcompinc_id = strtoupper($request->get('tcompinc_id'));
		$comp_ref_id = strtoupper($request->get('comp_ref_id'));

		$comp_referencia= Comprobante::find($comp_ref_id);


		$comp_id = Comprobante::create
		(
			[
				'comp_nro' => strtoupper($request->get('comp_nro')),
				'comp_fecha' => strtoupper($request->get('comp_fecha')),
				//'comp_guia' => strtoupper($request->get('comp_guia')),
				//'comp_est' => strtoupper($request->get('comp_est')),
				'comp_subt' => strtoupper($request->get('comp_subt')),
				'comp_igv' => strtoupper($request->get('comp_igv')),
				'comp_tot' => strtoupper($request->get('comp_tot')),
				'comp_saldo' => strtoupper($request->get('comp_saldo')),
				//'comp_cond' => strtoupper($request->get('comp_cond')),	
				'comp_tipcambio' => $comp_referencia->comp_tipcambio,
				'comp_moneda' => $comp_referencia->comp_moneda,
				'tcomp_id' => 4, // tipo notadebito
				'tcompinc_id' => strtoupper($request->get('tcompinc_id')),
				'ent_id' => $comp_referencia->entidad->ent_id,
				'vend_id' => strtoupper($request->get('vend_id')),
				'comp_est' => strtoupper($request->get('comp_est')),
				'comp_cond' => strtoupper($request->get('comp_cond')),
				
				//'comp_fpago' => strtoupper($request->get('comp_fpago')),
				//'comp_banco' => strtoupper($request->get('comp_banco')),
				//'comp_nope' => strtoupper($request->get('comp_nope')),
				//'comp_np' => strtoupper($request->get('comp_np')),
				
				'comp_ref' => $comp_ref_id,
				'comp_obs' => strtoupper($request->get('comp_obs')),
				'comp_fven' => strtoupper($request->get('comp_fven')),
				'comp_subt' => strtoupper($request->get('comp_subt')),
				'comp_tot' => strtoupper($request->get('comp_tot'))
			]
		)->comp_id;
		Operacion::create
		(
			[
				'tope_id' => 9, ///// tipo operacion nota de credito recibida
				'comp_id' => $comp_id,
				'ie_id' => 1 ///// para ie RESGUARDO
			]
		);

		return redirect("/validado/ndebitor")->with('creado','Nota de Débito Recibida creada');

	}
	public function getEditar(Request $request)
	{
		$this->validate($request,['comp_id'=>'required']);
		$comp_id=$request->get('comp_id');

		$comprobante = Comprobante::find($comp_id);

		$comprobante_ref = Comprobante::find($comprobante->comp_ref);
		
		$entidades = Entidad::where('tent_id','1')->orderBy('ent_rz','asc')->get();
		$tipocomprobanteincs = TipoComprobanteInc::where('tcomp_id',4)->where('tcompinc_cod','<>','05')->where('tcompinc_cod','<>','08')->where('tcompinc_cod','<>','09')->get();
		
		$vendedores = Vendedor::orderBy('vend_nom','asc')->get();
		
		return view('ndebitor.editar',['comprobante'=>$comprobante,'comprobante_ref'=> $comprobante_ref,'tipocomprobanteincs'=> $tipocomprobanteincs,'entidades'=>$entidades,'vendedores'=> $vendedores]);

	}

	public function postEditar(EditarNotaCreditoEmitidaRequest $request)
	{
		$tcompinc_id = strtoupper($request->get('tcompinc_id'));
		$comp_ref_id = strtoupper($request->get('comp_ref_id'));
		$comp_referencia= Comprobante::find($comp_ref_id);


		$comp_id=strtoupper($request->get('comp_id'));
		$comp_nro = strtoupper($request->get('comp_nro'));
		$comp_fecha = strtoupper($request->get('comp_fecha'));	
		$comp_tipcambio = $comp_referencia->comp_tipcambio;
		$comp_moneda = $comp_referencia->comp_moneda;
		$tcomp_id = '4';
		$tcompinc_id = strtoupper($request->get('tcompinc_id'));
		$comp_tot = strtoupper($request->get('comp_tot'));
		$ent_id = $comp_referencia->entidad->ent_id;	
		$vend_id = strtoupper($request->get('vend_id'));
		$comp_obs = strtoupper($request->get('comp_obs'));
		$comp_descrip = strtoupper($request->get('comp_descrip'));
		$comp_ref = $comp_ref_id;
		$comp_fven = strtoupper($request->get('comp_fven'));
		$comp_est = strtoupper($request->get('comp_est'));
		$comp_cond = strtoupper($request->get('comp_cond'));
		$comprobante = Comprobante::find($comp_id);


		$comprobante->comp_nro=$comp_nro;
		$comprobante->comp_fecha=$comp_fecha;
		$comprobante->comp_tipcambio=$comp_tipcambio;
		$comprobante->comp_moneda=$comp_moneda;
		$comprobante->tcomp_id=$tcomp_id;
		$comprobante->comp_tot=$comp_tot;
		$comprobante->tcompinc_id=$tcompinc_id;
		$comprobante->ent_id=$ent_id;
		$comprobante->vend_id=$vend_id;
		$comprobante->comp_obs=$comp_obs;
		$comprobante->comp_descrip=$comp_descrip;
		$comprobante->comp_est=$comp_est;
		$comprobante->comp_cond=$comp_cond;
		$comprobante->comp_ref=$comp_ref;
		$comprobante->comp_fven=$comp_fven;
		
		$comprobante->save();

		return redirect('/validado/ndebitor')->with('actualizado','Comprobante actualizado');
	}

	public function getEliminar(Request $request)
	{
		$this->validate($request,['comp_id'=>'required']);
		$comp_id=$request->get('comp_id');
		
		$detallecomprobantes = DetalleComprobante::where('comp_id',$comp_id)->get();
		DetalleComprobante::where('comp_id',$comp_id)->delete();

		///////////////////////// EDITANDO INVENTARIO ///////////////////////////////////////////////////
		foreach ($detallecomprobantes as $detallecomprobante) {

			$inventario=Inventario::where('prod_id',$detallecomprobante->unidadproducto->prod_id)->get();
			$inv_id=$inventario[0]->inv_id;
			
			$inventario=Inventario::find($inv_id);

			$um_producto=Producto::find($detallecomprobante->unidadproducto->prod_id)->um_id;
			$um_detalle=$detallecomprobante->unidadproducto->um_id;
			$cantidad=$detallecomprobante->dcomp_cant;
			$cantidad_ant=$inventario->inv_cant;

			if ($um_producto != $um_detalle) 
			{
				if((Conversion::where('um_id1',$um_producto)->where('um_id2',$um_detalle)->count())>(Conversion::where('um_id2',$um_producto)->where('um_id1',$um_detalle)->count()))
				{
					$conversion=Conversion::where('um_id1',$um_producto)->where('um_id2',$um_detalle)->get();
					$factor=$conversion[0]->conv_fact;
					$cantidad= ($cantidad/$factor);
				}
				else
				{
					$conversion=Conversion::where('um_id2',$um_producto)->where('um_id1',$um_detalle)->get();
					$factor=$conversion[0]->conv_fact;
					$cantidad= ($cantidad*$factor);
				}
			}

			$inventario->inv_cant=$cantidad_ant + $cantidad;
			$inventario->inv_fecha=Carbon::now();
			$inventario->save();
		
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////

		Operacion::where('comp_id',$comp_id)->delete();

		Comprobante::find($comp_id)->delete();

		return redirect('/validado/ndebitor')->with('eliminado','Nota de Debito eliminada');
	}


	public function missingMethod($parameters = array())
	{
		abort(404);
	}

}

