<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class BooksImportFileRule implements Rule
{
    protected $validExtensions = [
      'csv', 'xls', 'xlsx'
    ];


    private $file;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
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
        return in_array(strtolower($this->file->getClientOriginalExtension()), $this->validExtensions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Whoops, validation failed! Only csv documents are allowed.');
    }
}
