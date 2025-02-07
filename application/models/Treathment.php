<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Treathment extends Eloquent{
    protected $table = 'treathments';
    protected $fillable = ['parent_id', 'price', 'name', 'medicine_query', 'status'];
    use SoftDeletes;

    /**
     * Menu has many Children.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Treathment::class, 'parent_id', 'id');
    }

}
