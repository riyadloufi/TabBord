<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    protected $table = 'annees_scolaires';
    protected $fillable = ['libelle', 'en_cours', 'date_debut', 'date_fin'];
    protected $casts = ['en_cours' => 'boolean'];

    public function inscriptions() { return $this->hasMany(Inscription::class, 'annee_id'); }
    public function validations()  { return $this->hasMany(Validation::class, 'annee_id'); }
    public function abandons()     { return $this->hasMany(Abandon::class, 'annee_id'); }

    public static function encours()
    {
        return static::where('en_cours', true)->first();
    }
}
