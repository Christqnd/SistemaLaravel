<?php

namespace Sistema;

use Illuminate\Database\Eloquent\Model;

class valor_por_anho extends Model
{
	protected $table='valor_por_anho';
	protected $primaryKey='Anho';

	public $timestamps=false;

	protected $fillable=[
	'Anho','Mes','Valor'
	];

	protected $guarded=[
	];
}
