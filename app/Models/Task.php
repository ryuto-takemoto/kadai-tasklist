<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'status', 'user_id']; // content, status, user_idカラムへの一括代入を許可

    // Userモデルとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}