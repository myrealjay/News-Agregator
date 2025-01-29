<?php

namespace App\Models\Traits;

use App\Models\Preference;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasPreference
{
    /**
     * Model Preferences.
     * @return HasOne
     */
    public function preferences() : HasOne
    {
        return $this->hasOne(Preference::class);
    }
}
