<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Eloquent{
    protected $table = 'accounts';
    use SoftDeletes;


    /**
     * Account has one Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = account_id, localKey = id)
        return $this->hasOne(Role::class, 'id', 'role_id');
    }


    /**
     * Account has one Doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = account_id, localKey = id)
        return $this->hasOne(Doctor::class, 'user_id', 'id');
    }


    /**
     * Account has one Apoteker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apoteker()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = account_id, localKey = id)
        return $this->hasOne(Pharmacist::class, 'user_id', 'id');
    }
}
