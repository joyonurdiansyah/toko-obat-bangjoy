<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();
    if ($user->hasRole('buyer')) {
        $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
    } else {
        $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
    }

    return view('admin.product_transactions.index', [
        'product_transactions' => $product_transactions
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        return view('admin.product_transactions.details', [
            'productTransaction' => $productTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $productTransaction)
    {
        try {
            $productTransaction->update([
                'is_paid' => true
            ]);
    
            return redirect()->back()->with('success', 'Order has been approved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to approve the order. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
