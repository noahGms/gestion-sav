<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'nullable|integer|exists:customers,id',
            'comment_state' => 'nullable|string',
            'state_id' => 'nullable|integer|exists:states,id',
            'intervention_date' => 'nullable|date',
            'intervention_id' => 'nullable|integer|exists:interventions,id',
            'depot_id' => 'nullable|integer|exists:depots,id',
            'return_date' => 'nullable|date',
            'return_id' => 'nullable|integer|exists:returns,id',
            'type_id' => 'nullable|integer|exists:types,id',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'defaults' => 'nullable|string',
            'observations' => 'nullable|string',
            'reparations' => 'nullable|string',
            'comments' => 'nullable|string',
            'communications' => 'nullable|string',
        ];
    }
}
