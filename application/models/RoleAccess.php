<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

// use Illuminate\Database\Eloquent\SoftDeletes;


class RoleAccess extends Eloquent{
    protected $table = 'role_accesses';
    // use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'menu_id', 'role_id'
    ];


    /**
     * RoleAccess has one Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = roleAccess_id, localKey = id)
        return $this->hasOne(Role::class, 'role_id', 'id');
    }


    /**
     * RoleAccess has one Menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function menu()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = roleAccess_id, localKey = id)
        return $this->hasOne(Menu::class, 'menu_id', 'id');
    }

}
