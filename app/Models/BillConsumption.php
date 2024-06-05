<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillConsumption extends Model
{
    use HasFactory;
    protected $table = "bill_consumption";
    protected $primarykey = "id";
}
