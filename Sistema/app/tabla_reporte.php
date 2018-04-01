<?php

namespace Sistema;

use Illuminate\Database\Eloquent\Model;

class tabla_reporte extends Model
{
	protected $table='tabla_reporte';
	protected $primaryKey='Anho';

	public $timestamps=false;

	protected $fillable=[
	'Anho','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre','Maximo_Mes','Maximo','Minimo_Mes','Minimo'
	];

	protected $guarded=[
	];
}
