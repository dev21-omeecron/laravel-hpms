<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'did' => 'required|exists:doctreg,did',
      'spec' => 'required|string',
      'appdate' => 'required|date|after_or_equal:today',
      'apptime' => 'required',
    ];
  }

  public function messages(): array
  {
    return [
      'did.required' => 'Please select a doctor',
      'did.exists' => 'Selected doctor is invalid',
      'spec.required' => 'Please select specialization',
      'appdate.required' => 'Please select appointment date',
      'appdate.after_or_equal' => 'Appointment date must be today or future date',
      'apptime.required' => 'Please select appointment time',
    ];
  }
}
