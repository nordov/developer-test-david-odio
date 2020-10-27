<?php

    // Schema::create('employment', function (Blueprint $table) {
    //     $table->id();
    //     $table->integer('borrower_id')
    //                 ->references('id')
    //                 ->on('borrowers');
    //     $table->string('employeer_name')->nullable();
    //     $table->decimal('annual_income',9.2)->nullable();
    //     $table->timestamps();
    // });

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    //Correcting pluralization of table name
    protected $table = 'employment';

    protected $fillable = [
        'borrower_id',
        'employeer_name',
        'annual_income',
    ];

    public function borrower(){
        return $this->belongsTo('App\Borrower');
    }
}
