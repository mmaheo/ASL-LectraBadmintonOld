<?php

namespace App\Http\Requests;

class UserUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route()->getParameter('user_id');
        $user = $this->user();

        if ($user->hasOwner($user_id) || $user->hasRole('admin'))
        {
            return true;
        }

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
            'name'                => 'required',
            'forname'             => 'required',
            'email'               => 'unique:users,email|email',
            'password'            => 'confirmed|required_with:password_confirmation|min:6',
            'birthday'            => 'required|date_format:d/m/Y',
            'tshirt_size'         => 'required|in:XXS,XS,S,M,L,XL,XXL',
            'gender'              => 'required|in:man,woman',
            'state'               => 'required|in:hurt,holiday,active,inactive',
            'lectra_relationship' => 'required|in:lectra,child,conjoint,external,trainee,subcontractor',
            'newsletter'          => 'required|in:0,1',
            'avatar'         => 'image',
            'ending_holiday' => 'date_format:d/m/Y|required_if:active,holiday',
            'ending_injury'  => 'date_format:d/m/Y|required_if:active,hurt',
        ];
    }
}
