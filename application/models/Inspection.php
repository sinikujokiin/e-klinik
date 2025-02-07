<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Inspection extends Eloquent{
    protected $table = 'inspections';
    use SoftDeletes;

    protected $fillable = [
        'code','patient_id','doctor_id','symptom', 'diagnosis','treatment','status', 'cost', 'created_by', 'date', 'tension', 'height', 'weight'
    ];

    /**
     * Inspection has one Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = inspection_id, localKey = id)
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    /**
     * Inspection has one Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipe()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = inspection_id, localKey = id)
        return $this->hasOne(Recipe::class, 'inspection_id', 'id');
    }

     /**
     * Inspection has one Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = inspection_id, localKey = id)
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
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
