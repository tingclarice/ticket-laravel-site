<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['full_name', 'email', 'ticket_type', 'ticket_count'])]
class InterestRegistration extends Model
{
    protected function casts(): array
    {
        return [
            'ticket_count' => 'integer',
        ];
    }
}
