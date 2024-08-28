<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'id'); // Assuming the foreign key column is named 'role_id'
    }
    public function manger()
    {
        return $this->belongsTo(Manger::class, 'id'); // Assuming the foreign key column is named 'role_id'
    }
}
