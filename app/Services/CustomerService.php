<?php

namespace App\Services;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Address;
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
        $addressPayload = $request->validate((new AddressRequest())->rules());
        $customerPayload = $request->validate((new CustomerRequest())->rules());

        $address = Address::create($addressPayload);
        $customer = Customer::create(array_merge($customerPayload, [
            'address_id' => $address->id
        ]));

        return $customer;
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return Customer
     */
    public function update(Request $request, Customer $customer): Customer
    {
        $addressPayload = $request->validate((new AddressRequest())->rules());
        $customerPayload = $request->validate((new CustomerRequest())->rules());

        if (!empty($addressPayload)) {
            $customer->address()->update($addressPayload);
        }

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
        $customer->address()->delete();
        $customer->delete();
    }
}
