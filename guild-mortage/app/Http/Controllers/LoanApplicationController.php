<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanApplication;
use App\Borrower;
use App\Employment;
use App\BankAccount;

class LoanApplicationController extends Controller
{
    public function index(){
        return LoanApplication::all();
    }

    public function store(Request $request){
        $newLoanApplication = new LoanApplication;
        $newLoanApplicationInfo = [];
        $missingBorrowers = false;
        $missingEmployment = false;
        $missingBankAccounts = false;
        $errors = [];

        //Loan Application record
        if ($request->loan_application_amount){
            $newLoanApplication->loan_application_amount = $request->loan_application_amount;
            $newLoanApplication->loan_application_status = 'Submited';
        } else {
            return $errors = ["Record not saved: Missing loan application amount"];
        }

        //Save $newLoanApplcation to collect record id
        $newLoanApplication->save();

        //Borrower's records
        if($request->borrowers){
            foreach ($request->borrowers as $borrower){
                $newBorrower = new Borrower;
                $newBorrower->fname = $borrower['fname'];
                $newBorrower->lname = $borrower['lname'];
                $newBorrower->loan_application_id = $newLoanApplication->id;

                $newBorrower->save();

                //Borrower's employement records
                if($borrower['employment']){
                    foreach ($borrower['employment'] as $employeer){
                        $job = new Employment;
                        $job->employeer_name = $employeer['employeer_name'];
                        $job->annual_income = $employeer['annual_income'];
                        $newBorrower->calculated_annual_income += $job->annual_income;
                        $job->borrower_id = $newBorrower->id;
                        $job->save();
                    }

                    //update Boorower's annual income
                    $newBorrower->update(['calculated_annual_income']);

                } else {
                    $missingEmployment = true;
                }

                //Borrower's bank account records
                if($borrower['bank_accounts']){
                    foreach ($borrower['bank_accounts'] as $bank_account){
                        $account = new BankAccount;
                        $account->bank_name = $bank_account['bank_name'];
                        $account->account_number = $bank_account['account_number'];
                        $account->balance = $bank_account['balance'];
                        $account->borrower_id = $newBorrower->id;
                        $account->save();
                    }
                } else {
                    $missingBankAccounts = true;
                }
            }
        } else {
            array_push($errors, "Record saved with errors: Borrower's info missing");
        }

        if ($missingBorrowers) array_push($errors, "Attention: Borrower's employment info missing");
        else{
            if($missingEmployment) array_push($errors, "Attention: Borrower's employment info missing");
            if($missingBankAccounts) array_push($errors, "Attention: Borrower's bank account info missing");
        }

        if (sizeof($errors) > 0) return $errors;
        else {
            return LoanApplication::with('borrower','borrower.employments','borrower.bankAccounts')->where('id',$newLoanApplication->id)->get();
        }
    }

    public function show($id){
        $loanApplication = LoanApplication::findorfail($id);
        return $loanApplication::with('borrower','borrower.employments','borrower.bankAccounts')->where('id',$id)->get();
    }

    public function update(Request $request, $id){
        $loanApplication = LoanApplication::findorfail($id);

        if ($request->loan_application_amount) $loanApplication->loan_application_amount = $request->loan_application_amount;
        if ($request->loan_application_status) $loanApplication->loan_application_status = $request->loan_application_status;

        $loanApplication -> save();
        return $loanApplication;
    }

    public function destroy($id){

        //This is process is really inefficient, couldn;t resolve onDelete('cascade') for the table
        //so I am implementing this method to have at least working
        $loanApplication = LoanApplication::findorfail($id);
        $borrowers = $loanApplication->borrower()->get();

        foreach ($borrowers as $borrower){
            $borrower->employments()->delete();
            $borrower->bankAccounts()->delete();
        }

        $loanApplication->borrower()->delete();
        $loanApplication->delete();

        return "Deleted";

    }
}
