<?php

namespace App\Services;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService
{
    /**
     * @param Request $request
     * @return Customer $customer
     */
    public function store(Request $request): Customer
    {
        $customerPayload = $request->validate((new CustomerRequest())->rules());

        $customer = Customer::create($customerPayload);

        return $customer;
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return Customer
     */
    public function update(Request $request, Customer $customer): Customer
    {
        $customerPayload = $request->validate((new CustomerRequest())->rules());

        if (!empty($customerPayload)) {
            $customer->update($customerPayload);
        }

        return $customer;
    }

    /**
     * @param Customer $customer
     * @return void
     */
    public function delete(Customer $customer)
    {
        $customer->delete();
    }
}
