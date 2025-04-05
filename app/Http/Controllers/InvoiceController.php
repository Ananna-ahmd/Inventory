<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
        public function CreateInvoice(Request $request)
    {
        DB::beginTransaction();
        try {
        $user_id=$request->header('id');
        $total=$request->input('total');
        $discount=$request->input('discount');
        $vat=$request->input('vat');
        $payable=$request->input('payable');
        $customer_id=$request->input('customer_id');

        $invoice=Invoice::create([
            'total'=>$total,
            'discount'=>$discount,
            'vat'=>$vat,
            'payable'=>$payable,
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,

        ]);
        $invoice_id=$invoice->id;
        $products=$request->input('products');

        foreach ($products as $product) {
            InvoiceProduct::create([
                "invoice_id"=>$invoice_id,
                "user_id"=>$user_id,
                "product_id"=>$product['product_id'],
                "quantity"=>$product['quantity'],
                "sale_price"=>$product['sale_price'],

            ]);
            DB::commit();
            return response()->json(['status'=>'success','message'=>'Invoice Created Successfully'],200);

        }

    }
    catch (\Exception $e) {
        DB::rollBack();
        return 0;

    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
