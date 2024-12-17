<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parties extends Model
{
    use HasFactory;
    protected $table = "parties";
    protected $fillable = [
        'party_type',
        'Full_name',
        'Address',
        'Bank_Details',
        'Account_Number',
        'Bank_Name',
        'IFSC_Code',
        'ZIP_Code',
        'State',
        'Branch'
    ];
}
