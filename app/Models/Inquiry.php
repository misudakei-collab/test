<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
   // app/Models/Inquiry.php

    protected $fillable = ['name', 'email', 'country', 'gender', 'birthdate', 'tel', 'title', 'content', 'is_completed', 'is_read']; 
}

