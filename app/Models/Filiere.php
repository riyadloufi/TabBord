<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['code', 'intitule', 'type', 'nbr_semestres', 'actif'];
    protected $casts = ['actif' => 'boolean'];

    public function modules()      { return $this->hasMany(Module::class); }
    public function inscriptions() { return $this->hasMany(Inscription::class); }
    public function enseignants()  { return $this->hasMany(Enseignant::class); }
    public function abandons()     { return $this->hasMany(Abandon::class); }
}
