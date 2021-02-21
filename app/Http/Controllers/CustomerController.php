<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class CustomerController extends Controller
{
    public $currencies = [
        'KES',
        'USD'
    ];

    public function index(){
        return Inertia::render('Customers/Index',[
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'customers'=> Customer::paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    public function store(){
        Request::validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:50', 'email'],
            'phone' => ['required', 'max:50'],
            'defaultCurrency' => ['required'],
        ]);

        Customer::create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone' => Request::get('phone'),
            'status' => 'active',
            'defaultCurrency' => Request::get('defaultCurrency')
        ]);

        return Redirect::route('customers')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'defaultCurrency' => $customer->postal_code,
                'deleted_at' => $customer->deleted_at,
            ],
            'currencies'=>$this->currencies
        ]);
    }

    public function update(Customer $customer)
    {
        $customer->update(
            Request::validate([
                'name' => 'required|max:50',
                'email' =>  'max:50|email',
                'phone' => 'max:50',
                'defaultCurrency' => 'required',
            ])
        );

        return Redirect::route('customers')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Redirect::route('customers')->with('success', 'Customer deleted.');
    }

    public function restore(Customer $customer)
    {
        $customer->restore();

        return Redirect::route('customers')->with('success', 'Customer restored.');
    }
}
