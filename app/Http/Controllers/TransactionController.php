<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index(){
        return Inertia::render('Transactions/Index',[
            'filters' => Request::all('search', 'trashed'),
            'transactions'=> Transaction::with('sender','beneficiary')->paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('Transactions/Create',[
            'customers'=>Customer::orderBy('name')->get()->map->only('id', 'name'),
            'transaction_types'=>config('transactions.transaction_types'),
            'payment_methods'=>config('transactions.payment_methods'),
            'currencies'=>config('transactions.currencies'),
            'transaction_status'=>config('transactions.transaction_status'),
        ]);
    }

    public function store(TransactionRequest $request){
        $request->validated();

        Transaction::create([
            'SenderId' => Request::get('SenderId'),
            'BeneficiaryId' => Request::get('BeneficiaryId'),
            'amount'=>Request::get('amount'),
            'PaymentMethod'=>Request::get('PaymentMethod'),
            'TransactionType'=>Request::get('TransactionType'),
            'currency'=>Request::get('currency'),
            'status'=>Request::get('status'),
            'RefNo'=>strtoupper(uniqid('T'))
        ]);

        return Redirect::route('transactions')->with('success', 'Transaction created.');
    }

    public function edit(Transaction $transaction){
        return Inertia::render('Transactions/Edit', [
            'transaction' => $transaction,
            'customers'=>Customer::orderBy('name')->get()->map->only('id', 'name'),
            'transaction_types'=>config('transactions.transaction_types'),
            'payment_methods'=>config('transactions.payment_methods'),
            'currencies'=>config('transactions.currencies'),
            'transaction_status'=>config('transactions.transaction_status'),
        ]);
    }

    public function update(Transaction $transaction)
    {
        $transaction->update(
            Request::validate([
                'name' => 'required|max:50',
                'email' =>  'max:50|email',
                'phone' => 'max:50',
                'defaultCurrency' => 'required',
            ])
        );

        return Redirect::route('customers')->with('success', 'Transaction updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return Redirect::route('customers')->with('success', 'Transaction deleted.');
    }

    public function restore(Transaction $transaction)
    {
        $transaction->restore();

        return Redirect::route('customers')->with('success', 'Transaction restored.');
    }
}
