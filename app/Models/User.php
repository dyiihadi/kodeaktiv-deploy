<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pastikan ini ada
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: Seorang User memiliki banyak Project.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Project di mana user ini menjadi anggota
    public function sharedProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
