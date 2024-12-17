<?php
namespace App\Models;

use App\Models\GstBill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstBillItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'gst_bill_id',
        'SL_no',
        'item_description',
        'HSN_Code',
        'Quantity',
        'Rate',
        'Amount',
    ];

    public function gstBill()
    {
        return $this->belongsTo(GstBill::class);
    }
}
