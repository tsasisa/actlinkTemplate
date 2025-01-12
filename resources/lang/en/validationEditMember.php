<?php

return [
    'custom' => [
        'userName' => [
            'required' => 'The name field is required.',
            'string' => 'The name must be a string.',
            'max' => 'The name may not be greater than :max characters.',
        ],
        'userPhoneNumber' => [
            'required' => 'The phone number is required.',
            'regex' => 'The phone number must start with 08 and have at least 9 digits.',
            'max' => 'The phone number may not be greater than :max characters.',
        ],
        'memberDOB' => [
            'required' => 'The date of birth is required.',
            'date' => 'Please provide a valid date for the date of birth.',
        ],
        'memberPoints' => [
            'integer' => 'The points must be an integer.',
            'min' => 'The points must be at least :min.',
        ],
        'userType' => [
            'required' => 'The role field is required.',
            'in' => 'The selected role is invalid.',
        ],
        'organizerAddress' => [
            'required' => 'The address field is required for organizers.',
            'string' => 'The address must be a string.',
            'max' => 'The address may not be greater than :max characters.',
        ],
        'officialSocialMedia' => [
            'required' => 'The social media field is required for organizers.',
            'url' => 'Please provide a valid URL for the social media.',
            'max' => 'The social media URL may not be greater than :max characters.',
        ],
    ],
];
