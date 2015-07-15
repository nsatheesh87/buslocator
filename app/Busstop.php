<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Busstop extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'busstop';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	 protected $fillable = ['name', 'latitude', 'longitude', 'created_at', 'updated_at'];

}