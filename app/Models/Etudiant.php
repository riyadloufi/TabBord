<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['nom', 'prenom', 'cne', 'email', 'filiere_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function validations()
    {
        return $this->hasMany(Validation::class);
    }
}
