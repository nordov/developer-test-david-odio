<?php

    // Schema::create('loan_applications', function (Blueprint $table) {
    //     $table->id();
    //     $table->decimal('loan_application_amount',9,2);
    //     $table->enum('loan_application_status',['Submited','Processing','Approved','Rejected']);
    //     $table->timestamps();
    // });

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Borrower;

class LoanApplication extends Model
{
    protected $fillable = [
        'loan_application_amount',
        'loan_application_status',
    ];

    public function borrower(){
        return $this->hasMany('App\Borrower', 'loan_application_id', 'id');
    }

    public function delete(){

        $this->borrower()->delete();

        return parent::delete();
    }

}
