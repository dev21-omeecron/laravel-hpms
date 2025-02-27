<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      // Visible fields
      'prescription'    => 'required|string',
      'disease'         => 'required|string|max:100',
      'allergies'       => 'required|string|max:100',

      // Hidden fields (add validation)
      'aptid'           => 'required|exists:appointments,aptid',
      'pid'             => 'required|exists:appointments,pid',
      'patname'         => 'required|string|max:50',
      'appdate'         => 'required|date',
      'apptime'         => 'required|date_format:H:i',
      'payment_method'  => 'nullable|string|max:25',
      'payment_details' => 'nullable|string|max:255',
    ];
  }
}
