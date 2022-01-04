<?php

namespace App\Traits;

trait HasFullName
{
    /**
     * @return string|null
     */
    public function getFullNameAttribute(): ?string
    {
        if (!$this->lastname || !$this->firstname) {
            if ($this->lastname) {
                return $this->lastname;
            } elseif ($this->firstname) {
                return $this->firstname;
            } else {
                return null;
            }
        }
        return "{$this->firstname} {$this->lastname}";
    }
}
