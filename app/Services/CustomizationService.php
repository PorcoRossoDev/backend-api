<?php

namespace App\Services;

use App\Models\Customization;

class CustomizationService
{
    public function getType($requet)
    {
        $query = Customization::query();
        return $query->get();
    }
}