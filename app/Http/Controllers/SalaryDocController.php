<?php

namespace App\Http\Controllers;

use App\Models\AdvancePayment;
use App\Models\AdvancePaymentMonth;
use App\Models\Deduction;
use App\Models\Employer;
use App\Models\Reward;
use App\Models\SalaryDoc;
use App\Http\Requests\StoreSalaryDocRequest;
use App\Http\Requests\UpdateSalaryDocRequest;
use App\Models\SalaryDocDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalaryDocController extends Controller
{
    public function index(){
        $docs = SalaryDoc::query()->orderByDesc('created_at')->get();
        return view('salary.index',compact('docs'));
    }


    public function openSalaryDoc(){
        $data = [];
        $month_only = '';
        $state = 0;
        return view('salary.create',compact('data','month_only','state'));
    }

    public function getSalaryDoc(Request $request){
        $month = $request->month.'/'.Carbon::now()->year;
        $month_only = $request->month;



        $salaryDoc = SalaryDoc::query()->where('date',$month)->get()->first();

        $state = 0;
        $data = [];
        $employers = Employer::all();
        if($salaryDoc){
            $state = 1;
            $details = SalaryDocDetails::query()->where('salary_doc_id',$salaryDoc->id)->get();
            foreach ($details as $detail){
                $data[] = [
                    'employer_name' => Employer::find($detail->employer_id)->name,
                    'employer_id' => $detail->employer_id,
                    'hours' => $detail->hours,
                    'hour_value' => $detail->hour_value,
                    'reward' => $detail->reward,
                    'additional' => 0,
                    'advance_payment' => $detail->advance_payment,
                    'deductions'  => $detail->deductions
                ];
            }
        }else{
            foreach ($employers as $employer){

                $advancePayment = DB::table('advance_payment_months')
                    ->join('advance_payments','advance_payment_months.advance_payment_id','=','advance_payments.id')
                    ->select('advance_payment_months.*')
                    ->where('employer_id',$employer->id)
                    ->whereMonth('month',$request->month)
                    ->whereYear('month',Carbon::now()->year)->get()
                    ->sum('amount');

                $data[] = [
                    'employer_name' => $employer->name,
                    'employer_id' => $employer->id,
                    'hours' => $employer->salary,
                    'hour_value' => $employer->additional_salary,
                    'reward' => Reward::query()->where('employer_id',$employer->id)->whereMonth('created_at',$request->month)->whereYear('created_at',Carbon::now()->year)->get()->sum('amount'),
                    'additional' => 0,
                    'advance_payment' => $advancePayment,
                    'deductions'  => Deduction::query()->where('employer_id',$employer->id)->whereMonth('created_at',$request->month)->whereYear('created_at',Carbon::now()->year)->get()->sum('amount'),
                ];
            }
        }


        return view('salary.create',compact('data','month_only','state'));

    }


    public function storeSalary(Request $request ){
        $month = $request->month.'/'.Carbon::now()->year;
        $doc = SalaryDoc::create([
           'date' => $month,
           'state' => 1,
            'notes' => ''
        ]);

        foreach ($request->employer_id as $index=>$id){
            SalaryDocDetails::create([
                'employer_id' => $id,
                'hours' => $request->hours[$index],
                'hour_value' => $request->hour_value[$index],
                'reward' => $request->reward[$index],
                'additional' => 0,
                'advance_payment' => $request->advance_payment[$index],
                'deductions' => $request->deductions[$index],
                'salary_doc_id' => $doc->id
            ]);
        }

        $advance_payments = AdvancePaymentMonth::query()->whereMonth('month',$request->month)->whereYear('month',Carbon::now()->year)->get();
        foreach ($advance_payments as $payment){
            $payment->update([
                'state' => 1
            ]);

            $advancePayment = AdvancePayment::query()->where('id',$payment->advance_payment_id)->get()->first();
            $advancePayment->update([
                'remain' => $advancePayment->remain - $payment->amount
            ]);
        }


        return redirect()->route('salary_docs');
    }
}
