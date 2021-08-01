<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * ユーザー用モデルクラス
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'id',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    // meetingsテーブルとリレーションを定義
    public function meetings(){
        return $this -> hasMany('App\Models\Meeting');
    }
    
    // eventsテーブルとリレーションを定義
    public function events(){
        return $this -> hasMany('App\Models\Event');
    }
}
