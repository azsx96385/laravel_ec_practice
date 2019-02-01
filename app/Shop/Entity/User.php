<?php

namespace App\Shop\Entity; //命名空間-告訴要到哪個資料夾找到我

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model; //使用者類別中-繼承Model檔案

class User extends  Model  //Authenticatable
{
    //use Notifiable;

    protected $table='users'; //指定資料表名稱

    protected $primaryKey='id'; //指定主鍵名稱


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    protected $fillable = [  //可以大量指定異動的欄位 mass assignment
        'nickname', 'email', 'password','type','remember_token',
    ];

    //所有傳入的資料，會依據鍵值名稱，新增到資料表相對應的欄位中-又稱為 Mass assignment 大量指定異動的欄位
    //所傳入之資料，只要有寫在 Eloquent ORM　Model $fillable ，都可以做異動 ，反之則無法
    //因此 id created_at updated_at 皆無法傳入，所以我們設定自動給號-保護資料安全性與完整性






    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         
    ];
}
