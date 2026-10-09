<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diaper extends Model
{
    protected $fillable=[
        'day_id',
        'time',
        'type',
        'memo'
    ];

    public static $rules= [
        'date' => ['required','date'],
        'time' => ['required','date_format:H:i'],
        'type' => ['required','integer','in:1,2'],
        'memo' => ['nullable','string','max:255'],
    ];

    public static $messages = [
        'type.required' => 'おしっこ か うんち を選んでください',
        'memo.max' => 'メモは255文字以内で入力してください',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
