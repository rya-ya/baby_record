<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milk extends Model
{
    protected $fillable=[
        'day_id',
        'time',
        'amount',
        'memo'
    ];

    public static $rules= [
        'date' => ['required','date'],
        'time' => ['required','date_format:H:i'],
        'amount' => ['required','integer','min:1','max:3000'],
        'memo' =>['nullable','string','max:255'],
    ];

    public static $messages = [
        'amount.min' => 'ミルクの量を入力してください',
        'amount.max' => 'ミルクの量は最大3000mlまで入力できます',
        'memo.max' => 'メモは255文字以内で入力してください',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
