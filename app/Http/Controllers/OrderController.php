<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getOrder()
    {
        $order = Order::all();
        return response()->json([
            'data_order' => $order
        ]);
        
    }

    public function storeOrder(Request $request)
    {
        
        $customer = new Customer;
        $customer->customer_name = $request->customer_name;
        $customer->total_price = $request->total_price;
        $customer->save();
        foreach ($request->orders as $key => $value) {
            $customers = array(
                'id_customer' => $customer->id,
                'id_menu' => $value['id'],
                'qty' => $value['qty']
            );
            $order = Order::create($customers);
        }

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function getDetailOrder($id)
    {
        $order = Order::where('id_customer', $id)->with('customers', 'menus')->get();
        return response()->json([
            'data_order' => $order
        ]);
    }

    public function pdfOrder($id)
    {
        $data = Order::where('id_customer', $id)->with('menus')->get();
        $customer = Order::where('id_customer', $id)->with('customers')->first();
        $pdf = PDF::loadView('pdfOrder', compact('data', 'customer'));
        // return $pdf->download('Resto-Lumen-Orders.pdf');
        return $pdf->stream();
    }

}
