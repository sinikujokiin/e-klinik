<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class MedicineTransaction extends Eloquent{
    protected $table = 'medicine_transactions';
    use SoftDeletes;

    protected $fillable = [
        'medicine_id','qty','created_by'
    ];

    /**
     * Doctor has one User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = doctor_id, localKey = id)
        return $this->hasOne(Account::class, 'id', 'created_by');
    }

    /**
     * MedicineTransaction has one Medicine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function medicine()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = medicineTransaction_id, localKey = id)
        return $this->hasOne(Medicine::class, 'id', 'medicine_id');
    }

    /**
     * MedicineTransaction has one Recipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipe()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = medicineTransaction_id, localKey = id)
        return $this->hasOne(Recipe::class, 'created_at', 'created_at');
    }

}
