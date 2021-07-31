<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories(){
        return $this -> belongsToMany(Category::class);
    }

    public function author(){
        return $this -> belongsTo(User::class, foreignKey:'user_id', ownerKey:'id');
    }
}
  