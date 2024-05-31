<?php

namespace App\Http\Requests;

use App\Models\Datapelanggan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDatapelangganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('datapelanggan_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'age' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'string',
            ],
            'whatsapp' => [
                'nullable',
                'string',
            ],
            'bookingtime' => [
                'nullable',
                'string',
            ],
        ];
    }
}
