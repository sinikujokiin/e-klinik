<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Patient extends Eloquent{
    protected $table = 'patients';
    use SoftDeletes;

    protected $fillable = [
        'code','name','pob','dob', 'address','age','gender','phone','email','status','type', 'bpjs_number'
    ];

    /**
     * Patient has many Rm.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rm()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = patient_id, localKey = id)
        return $this->hasMany(Inspection::class)->with(['recipe.doctor', 'recipe.apoteker']);
    }
}
