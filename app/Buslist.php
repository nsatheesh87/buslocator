<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Buslist extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'buslist';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	 protected $fillable = ['busno', 'latitude', 'longitude', 'created_at', 'updated_at'];
}
