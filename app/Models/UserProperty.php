<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class UserProperty extends Pivot
{
    protected $table = 'user_property';

}
