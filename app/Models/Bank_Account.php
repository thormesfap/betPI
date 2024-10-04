<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_Account extends Model
{
    use HasFactory;
    protected $table = 'bank_accounts';
    protected $guarded = ['id']; 
}
