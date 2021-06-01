<?php

namespace App\Rules;

use App\Models\MWorker;
use Illuminate\Contracts\Validation\Rule;

class WorkerExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $mWorker = MWorker::query()->find($value);
        return $mWorker!==null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The worker does not exists';
    }
}
