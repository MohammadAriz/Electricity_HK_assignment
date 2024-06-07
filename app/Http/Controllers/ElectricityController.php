<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\UserBill;
use App\Models\BillConsumption;

class ElectricityController extends Controller
{
    public function dashboard()
    {
        return view('index');
    }
    public function index()
    {
        $users = Customer::paginate(10);
        return view('admin.electricity.customers_list', compact('users'));
    }
    public function create_customers()
    {
        return view('admin.electricity.create_customers');
    }
    public function store_customers(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required',
            'city' => 'required'
        ]);
        $store = new Customer;
        $store->name = $request->name;
        $store->address = $request->address;
        $store->email = $request->email;
        $store->mobile = $request->mobile;
        $store->city = $request->city;
        $store->save();
        return redirect('/customers');
    }

    public function edit_customers($id)
    {
        $edit = Customer::find($id);
        return view('admin.electricity.update_customers', compact('edit'));


    }
    public function update_customers(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'city' => 'required'
        ]);
        $update = Customer::find($id);
        $update->name = $request->name;
        $update->address = $request->address;
        $update->email = $request->email;
        $update->mobile = $request->mobile;
        $update->city = $request->city;
        $update->save();
        return redirect('/customers');
    }
    public function delete_customers($id)
    {
        Customer::find($id)->delete();
        return redirect()->back();
    }

    //FOR BILL GENERATION

    public function generate_bill()
    {
        return view('admin.electricity.generate_bill');
    }


    // public function store_bill(Request $request)
    // {
    //     $int = intval($request->unit_consumption);

   
    //     $bills = BillConsumption::select('start_unit', 'end_unit', 'amount')->orderBy('amount')->get();
    //     
    //     if ($bills) {
    //         if ($int < $bills[0]['end_unit']) {
    //             $amount = $int * $bills[0]['amount'];
    //             dd($amount);
    //         } elseif ($int >= $bills[1]['start_unit'] && $int <= $bills[1]['end_unit']) {


    //             $rem = $int - $bills[0]['end_unit'];
    //             $sum = $bills[0]['end_unit'] * $bills[0]['amount'];
    //             $sum = $sum + $rem * $bills[1]['amount'];
    //             dd($sum);




    //         } elseif ($int >= $bills[2]['start_unit'] && $int <= $bills[2]['end_unit']) {

    //             $rem = $int - $bills[1]['end_unit'];
    //             $sum = $bills[0]['end_unit'] * $bills[0]['amount'];
    //             $sum = $sum + ($bills[1]['end_unit'] - $bills[0]['end_unit']) * $bills[1]['amount'];
    //             
    //             $sum = $sum + $rem * $bills[2]['amount'];
    //             dd($sum);           


    //         } elseif ($int >= $bills[3]['start_unit']) {

    //             $rem = $int - $bills[2]['end_unit'];
    //             $sum = $bills[0]['end_unit'] * $bills[0]['amount'];
    //             $sum = $sum + ($bills[1]['end_unit'] - $bills[0]['end_unit']) * $bills[1]['amount'];
    //             $sum = $sum + ($bills[2]['end_unit'] - $bills[1]['end_unit']) * $bills[2]['amount'];
    //             $sum = $sum + $rem * $bills[3]['amount'];
    //             dd($sum);
    //         }
    //     }

    // }

    public function store_bill(Request $request)
    {
        // dd($request->all());
        $int = intval($request->unit_consumption);
        $bills = BillConsumption::select('start_unit', 'end_unit', 'amount')->orderBy('amount')->get();

        if ($bills) {
            $sum = 0;
            $remaining_units = $int;
            $previous_end_unit = 0;

            foreach ($bills as $bill) {
                if ($bill->end_unit !== null && $remaining_units > $bill->end_unit) {
                    $consumed_units = $bill->end_unit - $previous_end_unit;
                    $sum = $sum + $consumed_units * $bill->amount;
                    $remaining_units =  $remaining_units - $consumed_units;
                    $previous_end_unit = $bill->end_unit;
                } else {
                    $sum = $sum + $remaining_units * $bill->amount;
                    break;
                }
            }

            // dd($sum);
            $new = new UserBill;
            $new->user_id = $request->user_id;
            $new->month = $request->month;
            $new->unit_consumed = $int;
            $new->amount = $sum;
            $new->save();
            return back();


        }
    }
    public function user_bills()
    {
        $users = UserBill::paginate(10);
        return view('admin.electricity.bill_list', compact('users'));

    }

}
