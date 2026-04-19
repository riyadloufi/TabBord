<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['nom', 'code', 'coefficient'];

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class);
    }

    public function validations()
    {
        return $this->hasMany(Validation::class);
    }
}
