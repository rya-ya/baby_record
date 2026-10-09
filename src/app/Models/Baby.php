<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Baby extends Model
{
    protected $fillable =[
        'name' ,
        'gender' ,
        'birthday',
        'memo',
        'home_id',
    ];

    public static $rules= [
        'name' => ['required','string','max:20'],
        'gender' => ['required','integer','in:1,2'],
        'birthday' => ['required','date','before_or_equal:today'],
        'memo' =>['nullable','string','max:255'],
    ];

    public static $messages = [
        'name.required' => '名前を入力してください',
        'name.max' => '名前は20文字以内で入力してください',
        'gender.required' => '性別を選択してください',
        'birthday.required' => '誕生日を選択してください',
        'birthday.before_or_equal' => '誕生日は本日以前を選択してください',
        'memo.max' => 'メモは255文字以内で入力してください',
    ];

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

   public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function getAgeAttribute()
    {
        $birthday = Carbon::parse($this->birthday);
        $now = Carbon::now();

        $years = (int)$birthday->diffInYears($now);
        $months = (int)$birthday->copy()->addYears($years)->diffInMonths($now);

        return "{$years}才{$months}か月";
    }


}
