<?php

namespace App\Http\Requests;

class UserCreateRequest extends UserRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->commonRules();
    }
}
