<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Contracts\Validation\Validator;

class CategoryUpdateRequest extends CategoryStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return parent::rules();
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('put') && $this->slugExists()) {
                $validator->errors()
                    ->add('slug', 'This slug already exists');
            }
            return;
        });
        return $validator;
    }
    /**
     * @return bool
     */
    private function slugExists(): bool
    {
        $category = Category::where('slug', '=', $this->getSlug())
            ->where('id', '!=', $this->route()->parameter('category')->id)
            ->first();
        if (!empty($category)) {
            return true;
        }
        return false;
    }
    /**
     * @return string
     */
    public function getSlug(): string
    {
        return ($this->input('slug')) ?? parent::getSlug();
    }
}
