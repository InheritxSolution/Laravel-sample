<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = 'cms';
    protected $primaryKey = 'id';
	protected $fillable = ['content', 'lang', 'type'];
	protected $dates = ['created_at', 'updated_at'];
}
