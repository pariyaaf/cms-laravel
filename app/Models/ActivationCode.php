<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ActivationCode extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'code', 'used', 'expire'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCreateCode($query, User $user) {
        $code = $this->code();
        return $query->create([
            'user_id' =>$user->id,
            'code' => $code,
            'expire' => Carbon::now()->addMinutes(15),

        ]);
    }

    private function code(){
        do {
            $code = Str::random(60);
            $check_code = Static::whereCode($code)->get();
        }
        while(!$check_code->empty());
        return $code;
    }



}
