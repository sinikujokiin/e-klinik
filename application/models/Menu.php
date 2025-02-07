<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Eloquent{
    protected $table = 'menus';
    use SoftDeletes;

    /**
     * Menu has many Children.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        $role_id = user()->role_id;
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = menu_id, localKey = id)
        return $this->hasMany(Menu::class, 'parent_id', 'id');
        // ->with(['children' => function($query) use($role_id){
        //     $query->select('menus.*', 'm.name as parent_name', 'm.id as id_parent');
        //     $query->join('menus as m', 'menus.parent_id', '=', 'm.id');
        //     $query->join('role_accesses', 'role_accesses.menu_id', '=', 'menus.id');
        //     $query->where('role_id', $role_id);
        //     $query->orderBy('sort', 'asc');
        // }]);
    }

}
