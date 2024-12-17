<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GstBillItem;

class GstBill extends Model
{
    use HasFactory;
    protected $table = 'gst_bills';

    protected $fillable = [
        'party_name',
        'invoice_date',
        'order_date',
        'invoice_number',
        'sl_no',
        'item_description',
        'hsn_code',
        'quantity',
        'rate',
        'amount',
        'total_amount',
        'cgst_rate',
        'sgst_rate',
        'igst_rate',
        'cgst_amount',
        'sgst_amount',
        'igst_amount',
        'tax_amount',
        'net_amount',
        'declaration',
    ];

    // public function items()
    // {
    //     return $this->hasMany(GstBillItem::class);
    // }
}
