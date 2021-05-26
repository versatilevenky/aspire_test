<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans';
    protected $fillable = ['user_id' , 'request_amount', 'term', 'user_remarks'];

    const LOAN_STATUS_PENDING = 0;
    const LOAN_STATUS_APPROVED = 1;
    const LOAN_STATUS_REJECTED = 2;
    const LOAN_STATUS_CLEARED = 3;

    public function loanUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function loanManager()
    {
        return $this->hasOne('App\Models\User', 'id', 'approved_by');
    }

    public function loanRepayment()
    {
        return $this->hasMany('App\Models\LoanRepayment', 'loan_id', 'id');
    }
}
