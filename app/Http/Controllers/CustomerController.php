<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getCustomer()
    {
        $customer = Customer::all();
        return response()->json([
            'data_customer' => $customer
        ]);
    }

    public function storeCustomer(Request $request)
    {
        $customer = new Customer;
        $customer->customer_name = $request->customer_name;
        $customer->total_price = $request->total_price;
        $customer->save();

        return response()->json([
            'message' => 'New Customer Added',
            'data_customer' => $customer
        ]);
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'message' => 'delete success'
        ]);
    }
}
