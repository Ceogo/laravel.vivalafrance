<?php

namespace App\Models;

use App\Models\Owner;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function owner()
    {
        return $this->hasOne(Owner::class);
    }
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
}
