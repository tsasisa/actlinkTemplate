<?php

return [

    //edit-organizer
    'custom' => [
        'userName' => [
            'required' => 'Kolom nama wajib diisi.',
            'string' => 'Nama harus berupa teks.',
            'max' => 'Nama tidak boleh lebih dari :max karakter.',
        ],
        'organizerAddress' => [
            'required' => 'Kolom alamat wajib diisi.',
            'string' => 'Alamat harus berupa teks.',
            'max' => 'Alamat tidak boleh lebih dari :max karakter.',
        ],
        'officialSocialMedia' => [
            'required' => 'Kolom media sosial wajib diisi.',
            'url' => 'Harap masukkan URL yang valid untuk media sosial.',
            'max' => 'URL media sosial tidak boleh lebih dari :max karakter.',
        ],
        
    ],
];
