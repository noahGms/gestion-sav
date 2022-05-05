<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerLiteResource;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Customer::query();

        if ($search = $request->query('search')) {
            $query = Customer::search($search)->constrain($query);
        }

        $customers = $query->paginate($request->get('pageSize', 10));

        return CustomerResource::collection($customers);
    }

    /**
     * Display a lite listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function lite(): AnonymousResourceCollection
    {
        return CustomerLiteResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $customer = $this->customerService->store($request);
        return response()->json([
            'message' => 'Le client a bien été créé',
            'data' => CustomerResource::make($customer),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return CustomerResource
     */
    public function show(Customer $customer): CustomerResource
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $this->customerService->update($request, $customer);
        return response()->json(['message' => 'Le client a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $this->customerService->delete($customer);
        return response()->json(['message' => 'Le client a bien été supprimé']);
    }
}
