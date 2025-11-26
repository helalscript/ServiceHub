<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantInformation extends Model
{
    use HasFactory;

    protected $table = 'applicant_informations';

    protected $fillable = [
        'loan_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'street_address',
        'city',
        'state',
        'zip',
        'information_type',
    ];

    protected $casts = [
        'id' => 'integer',
        'loan_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'birth_date' => 'date:Y-m-d',
        'street_address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zip' => 'string',
        'information_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
