<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
        $query->where('name', 'like', '%'.  $search . '%'));

        $query->when($filters['status_code'] ?? false, fn($query, $status_code) => 
            $query->whereExists( fn($query) =>
                $query->from('status_codes')
                    ->join('transactions', 'status_codes.id' , '=', 'transactions.status_code_id')
                    ->where('status_codes.status_code_name', $status_code))
                );

        $query->when($filters['currency'] ?? false, fn($query, $currency) => 
        $query->whereExists( fn($query) =>
            $query->from('currencys')
                ->join('transactions', 'currencys.id' , '=', 'transactions.currency_id')
                ->where('currencys.currency_name', $status_code))
            );

        $query->when($filters['min_amount'] ?? false, fn($query, $search) => 
        $query->where('name', 'like', '%'.  $search . '%'));

        $query->when($filters['min_date'] ?? false, fn($query, $search) => 
        $query->where('name', 'like', '%'.  $search . '%'));
    }
}
