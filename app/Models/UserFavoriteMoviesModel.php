<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserFavoriteMoviesModel extends Model 
{
    use Notifiable;
   
    protected $table = "user_favorite_movies";
 

   
    
}