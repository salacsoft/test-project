<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $table = "promotions";
 
    public $mechanics = ["winning-moment", "chance-probability", "lucky-pick"];
 
    protected $fillable = ["client_name", "client_slug", "description", "mechanic", "prize", "start_time"];
 

    public function requiredFields()
    {
        return $this->hasMany(RequiredInfo::class, "promotion_id");
    }
 
    public function scopeRandomPick($query)
    {
       return $query->inRandomOrder()->first();
    }
 
    public function scopeEveryNthOf($query, $nth)
    {
       return $query->skip($nth - 1)->first();
    }
 
    public function scopeFirstEntry($query)
    {
       return $query->where("start_time", ">=", $startTime)->firs();
    }

    public function setClientNameAttribute($client_slug)
    {
       $this->attributes['client_name'] = trim($client_slug);
       $this->attributes['client_slug'] = Str::of(trim($client_slug))->slug("-");
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
