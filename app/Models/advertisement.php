<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
class advertisement extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user(){
    return $this->hasOne(User::class, "id", "user_id", advertisement::class);
    }
    public function titles(){
        return $this->hasMany(advertisement::class, 'id', 'id', advertisement::class)->where('search_find','search')->orderBy('created_at', 'desc');
    }
    public function allads(){
        return $this->hasMany(advertisement::class, 'id', 'id', advertisement::class)->where('approve', 1)->orderBy('created_at','desc');
    }
    public function found(){
    return $this->hasMany(advertisement::class, 'id', 'id', advertisement::class)->where('search_find','find');
    }
    
}

