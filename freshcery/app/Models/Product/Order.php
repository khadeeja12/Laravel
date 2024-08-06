<?php

namespace App\Models\Product;

use App\Models\Product\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table="orders";
    protected $fillable=[
        "name",
        "last_name",
        "address",
        "town",
        "state",
        "zip_code",
        "email",
        "phone_number",
        "price",
        "user_id",
        "order_notes",
        "status",
    ];
    public $timestamps=true;
}
