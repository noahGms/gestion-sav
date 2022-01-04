<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $values = [
            'number' => $this->street_number,
            'street' => $this->street_name,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
        ];

        $full_address = '';
        foreach ($values as $value) {
            if ($value !== null && is_string($value)) {
                $full_address .= $value . ' ';
            }
        }
        return $full_address;
    }
}
