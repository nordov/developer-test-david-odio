<?php

    // Schema::create('bank_accounts', function (Blueprint $table) {
    //     $table->id();
    //     $table->integer('borrower_id')
    //                 ->references('id')
    //                 ->on('borrowers');
    //     $table->string('bank_name')->nullable();
    //     $table->string('account_number')->nullable();
    //     $table->decimal('balance',9,2)->nullable();
    //     $table->timestamps();
    // });

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'borrower_id',
        'bank_name',
        'account_number',
        'balance'
    ];

    public function borrower(){
        return $this->belongsTo('App\Borrower');
    }
}
