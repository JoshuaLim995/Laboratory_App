<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanToken extends Model
{
    protected $fillable = [
	'loan_id', 
	'token_approve',
	'token_decline',
	];
}
