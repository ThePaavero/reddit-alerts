<?php

class Item extends Eloquent {

	protected $guarded = array('id');
	protected $table = 'items';
	public static $rules = array();

}
