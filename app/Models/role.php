<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class Role extends Model
{
    //
    protected $fillable = ['name'];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
