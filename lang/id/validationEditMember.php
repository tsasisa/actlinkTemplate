<?php

return [
    'custom' => [
        'userName' => [
            'required' => 'Kolom nama wajib diisi.',
            'string' => 'Nama harus berupa teks.',
            'max' => 'Nama tidak boleh lebih dari :max karakter.',
        ],
        'userPhoneNumber' => [
            'required' => 'Kolom nomor telepon wajib diisi.',
            'regex' => 'Nomor telepon harus dimulai dengan 08 dan memiliki setidaknya 9 digit.',
            'max' => 'Nomor telepon tidak boleh lebih dari :max karakter.',
        ],
        'memberDOB' => [
            'required' => 'Kolom tanggal lahir wajib diisi.',
            'date' => 'Harap masukkan tanggal lahir yang valid.',
        ],
        'memberPoints' => [
            'integer' => 'Poin harus berupa angka.',
            'min' => 'Poin harus minimal :min.',
        ],
        'userType' => [
            'required' => 'Kolom peran wajib diisi.',
            'in' => 'Peran yang dipilih tidak valid.',
        ],
        'organizerAddress' => [
            'required' => 'Kolom alamat wajib diisi untuk penyelenggara.',
            'string' => 'Alamat harus berupa teks.',
            'max' => 'Alamat tidak boleh lebih dari :max karakter.',
        ],
        'officialSocialMedia' => [
            'required' => 'Kolom media sosial wajib diisi untuk penyelenggara.',
            'url' => 'Harap masukkan URL media sosial yang valid.',
            'max' => 'URL media sosial tidak boleh lebih dari :max karakter.',
        ],
    ],
];
