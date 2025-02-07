<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Recipe extends Eloquent{
    protected $table = 'recipes';
    use SoftDeletes;

    
    /**
     * Recipe has one Inspection.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inspection()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = recipe_id, localKey = id)
        return $this->hasOne(Inspection::class, 'id', 'inspection_id')->with('patient');
    }

    /**
     * Recipe has one Doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = recipe_id, localKey = id)
        return $this->hasOne(Doctor::class, 'id', 'created_by');
    }


    /**
     * Recipe has one Apoteker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apoteker()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = recipe_id, localKey = id)
        return $this->hasOne(Pharmacist::class, 'id', 'apoteker_id');
    }

    /**
     * Recipe has many Transation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = recipe_id, localKey = id)
        return $this->hasMany(MedicineTransaction::class, 'created_at', 'created_at')->with('medicine');
    }

}
