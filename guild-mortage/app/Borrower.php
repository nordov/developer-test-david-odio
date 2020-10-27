<?php

    // Schema::create('borrowers', function (Blueprint $table) {
    //     $table->id();
    //     $table->integer('loan_application_id')
    //                 ->references('id')
    //                 ->on('loan_applications');
    //     $table->string('fname')->nullable();
    //     $table->string('lname')->nullable();
    //     $table->decimal('calculated_annual_income',9,2)->nullable();
    //     $table->timestamps();
    // });

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'loan_application_id',
        'fname',
        'lname',
        'calculated_annual_income'
    ];

    public function loanApplication(){
        return $this->belongsTo('App\LoanApplication', 'loan_application_id', 'id');
    }

    public function employments(){
        return $this->hasMany('App\Employment');
    }

    public function bankAccounts(){
        return $this->hasMany('App\BankAccount');
    }

    public function delete(){
            $this->employments()->delete();
            $this->bankAccounts()->delete();

            return parent::delete();
    }

    // protected function calculateAnnualIncome(){
    //     $employments = $this->employments;

    //     foreach ($employments as $employeer){
    //         $this->calculated_annual_income += $employeer->annual_income;
    //     }
    // }
}
