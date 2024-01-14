<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public static function spannignPayment($month=6, $payment=1) {
        return Payment::selectRaw('MONTHNAME(created_at) as month, COUNT(*) as published, MIN(created_at) as min_created_at')
            ->where('created_at', '>', Carbon::now()->subMonths($month))
            ->where('payment' , $payment)
            ->groupBy(DB::raw('month'))
            ->orderBy('month', 'desc');

    }
}
