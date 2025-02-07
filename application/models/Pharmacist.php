<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Pharmacist extends Eloquent{
    protected $table = 'pharmacists';
    use SoftDeletes;

    protected $fillable = [
        'user_id','code','no_reg','name','pob', 'dob','gender','status'
    ];

    /**
     * Pharmacist has one User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = doctor_id, localKey = id)
        return $this->hasOne(Account::class, 'id', 'user_id');
    }
}
