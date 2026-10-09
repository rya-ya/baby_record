<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    protected $fillable=[
        'day_id',
        'start_time',
        'end_time',
        'memo'
    ];

    public static $rules= [
        'date' => ['required','date'],
        'start_time' => ['required','date_format:H:i'],
        'end_time' => ['required','date_format:H:i'],
        'memo' =>['nullable','string','max:255'],
    ];

    public static $messages = [
        'memo.max' => 'メモは255文字以内で入力してください',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
