<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

class MpPayments extends Model
{
    protected $table = "mp_payments";

    protected $guarded = ["id",
							"mp_id",
							"assinante_id",
							"rv_status",
							"mp_status"];
}
