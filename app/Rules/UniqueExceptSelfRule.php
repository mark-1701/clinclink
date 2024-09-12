<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueExceptSelfRule implements ValidationRule
{
    protected $table;
    protected $attribute;
    protected $ignoreId;
    protected $value;

    public function __construct($table, $attribute, $ignoreId = null, $value)
    {
        $this->table = $table;
        $this->attribute = $attribute;
        $this->ignoreId = $ignoreId;
        $this->value = $value;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // clase en construcccion
    }
}
