<?php

namespace nullx27\Herald\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discord_guild_id' => 'required|numeric|digits:18',
            'annoucement_channel_id' => 'required|numeric|digits:18',
            'rsvp_emoji' => 'required'
        ];
    }
}

