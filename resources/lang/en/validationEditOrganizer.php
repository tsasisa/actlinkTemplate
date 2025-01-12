<?php

return [

    //edit-organizers
    'custom' => [
        'userName' => [
            'required' => 'The name field is required.',
            'string' => 'The name must be a string.',
            'max' => 'The name may not be greater than :max characters.',
        ],
        'organizerAddress' => [
            'required' => 'The address field is required.',
            'string' => 'The address must be a string.',
            'max' => 'The address may not be greater than :max characters.',
        ],
        'officialSocialMedia' => [
            'required' => 'The social media field is required.',
            'url' => 'Please provide a valid URL for the social media.',
            'max' => 'The social media URL may not be greater than :max characters.',
        ],
        
    ],
];
