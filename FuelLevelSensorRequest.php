<?php

namespace App\Http\Requests;

use App\Models\FuelLevelSensor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class FuelLevelSensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'model' => 'required|string|in:' . implode(',', FuelLevelSensor::MODELS),
                'name' => 'required|string|max:255',
                'tracker_id' => 'required|int|exists:trackers,id',
                'params' => 'nullable|array',
            ];
        } else {
            return [
                'model' => 'string|in:' . implode(',', FuelLevelSensor::MODELS),
                'name' => 'string|max:255',
                'tracker_id' => 'int|exists:trackers,id',
                'params' => 'nullable|array',
            ];
        }
    }
}
