<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;

class CategoryStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:191',
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('post') && $this->slugExists()) {
                $validator
                    ->errors()
                    ->add('title', 'Category with this name already exists!');
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
        $category = Category::where('slug', '=', $this->getSlug())->first();

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
        return Str::slug($this->getTitle());
    }
    /**
     * @return null|string
     */
    public function getTitle(): ? string
    {
        return $this->input('title');
    }
}
