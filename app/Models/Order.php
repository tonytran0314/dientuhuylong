<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'Amount',
        'status_id',
        'order_time',
        'updated_at',
        'payment_method_id',
        'payment_status_id',
        'phone_number',
        'email',
        'address'
    ];

    public $incrementing = false;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo {
        return $this->belongsTo(OrderStatus::class);
    }

    public function payment_method(): BelongsTo {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payment_status(): BelongsTo {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function items_in_order(): BelongsToMany {
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }
    
}
