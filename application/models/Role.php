<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Eloquent{
    protected $table = 'roles';
    use SoftDeletes;

}
