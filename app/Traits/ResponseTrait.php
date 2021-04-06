<?php


namespace App\Traits;


use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

trait ResponseTrait
{
    public function notFoundResponse($class) {
        $modelClass = strtolower(class_basename($class));
        return (new ErrorResource([
            "messages" => __('response.not_found', ['object' => __("models.{$modelClass}")]),
            "status" => Response::HTTP_NOT_FOUND
        ]))->response();
    }

    public function failedValidationResponse(Validator $validator, $messages = null) {
        return (new ErrorResource([
            "messages" => $messages ?? __('response.validation_failed'),
            "validation" => $validator->errors(),
        ]))->response();
    }
}
