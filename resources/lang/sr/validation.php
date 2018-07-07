<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':Attribute mora biti prihvaćen.',
    'active_url'           => ':Attribute nije validan URL.',
    'after'                => ':Attribute mora biti datum nakon :date.',
    'alpha'                => ':Attribute sme da sadrži samo slova.',
    'alpha_dash'           => ':Attribute sme da sadrži samo slova, brojeve i crtice.',
    'alpha_num'            => ':Attribute sme da sadrži samo slova i brojeve .',
    'array'                => ':Attribute mora biti niz.',
    'before'               => ':Attribute mora biti datum pre :date.',
    'between'              => [
        'numeric' => ':Attribute mora imati vrednost između :min i :max.',
        'file'    => ':Attribute mora biti veličine između :min i :max kilobajta.',
        'string'  => ':Attribute mora biti dužine između :min i :max karaktera.',
        'array'   => ':Attribute mora imati između :min i :max elemenata.',
    ],
    'boolean'              => 'Polje :attribute mora biti true ili false.',
    'confirmed'            => ':Attribute potvrđivanje se ne poklapa.',
    'date'                 => ':Attribute nije validan datum.',
    'date_format'          => ':Attribute mora biti datog formata :format.',
    'different'            => ':Attribute i :other moraju biti različiti.',
    'digits'               => ':Attribute mora imati :digits cifara.',
    'digits_between'       => ':Attribute mora imati između :min i :max cifara.',
    'dimensions'           => ':Attribute nije odgovarajućih dimenzija.',
    'distinct'             => 'Polje :attribute ima ponovljenu vrednost.',
    'email'                => ':Attribute mora biti validna email adresa.',
    'exists'               => 'Odabrani :attribute nije validan.',
    'file'                 => ':Attribute mora biti fajl.',
    'filled'               => ':Attribute je obavezan.',
    'image'                => ':Attribute mora biti slika.',
    'in'                   => 'Odabrani :attribute nije validan.',
    'in_array'             => 'Polje :attribute ne postoji u :other.',
    'integer'              => ':Attribute mora biti ceo broj.',
    'ip'                   => ':Attribute mora biti validna IP adresa.',
    'json'                 => ':Attribute mora biti validan JSON string.',
    'max'                  => [
        'numeric' => ':Attribute ne sme biti veći od :max.',
        'file'    => ':Attribute ne sme biti veći od :max kilobajta.',
        'string'  => ':Attribute ne sme biti duži od :max karaktera.',
        'array'   => ':Attribute ne sme da ima više od :max elemenata.',
    ],
    'mimes'                => ':Attribute mora biti fajl formata: :values.',
    'mimetypes'            => ':Attribute mora biti fajl formata: :values.',
    'min'                  => [
        'numeric' => ':Attribute mora biti najmanje :min.',
        'file'    => ':Attribute mora imati najmanje :min kilobajta.',
        'string'  => ':Attribute mora imati najmanje :min karaktera.',
        'array'   => ':Attribute mora imati najmanje :min elemenata.',
    ],
    'not_in'               => 'Odabrani :attribute nije validan.',
    'numeric'              => ':Attribute mora biti broj.',
    'present'              => 'Polje :attribute mora biti prisutno.',
    'recaptcha'            => 'Recaptcha validacija nije prošla.',
    'regex'                => ':Attribute nije validnog formata.',
    'required'             => 'Polje :attribute je obavezno.',
    'required_if'          => 'Polje :attribute je obavezno kada :other ima sledeću vrednost: :value.',
    'required_unless'      => 'Polje :attribute je obavezno sem kada :other ima sledeću vrednost: :values.',
    'required_with'        => 'Polje :attribute je obavezno kada :values su prisutni.',
    'required_with_all'    => 'Polje :attribute je obavezno kada :values su prisutni.',
    'required_without'     => 'Polje :attribute je obavezno kada :values nisu prisutni.',
    'required_without_all' => 'Polje :attribute je obavezno kada nijedan od :values nisu prisutni.',
    'same'                 => ':Attribute i :other moraju da se poklapaju.',
    'size'                 => [
        'numeric' => ':Attribute mora biti veličine :size.',
        'file'    => ':Attribute mora biti :size kilobajta.',
        'string'  => ':Attribute mora imati :size karaktera.',
        'array'   => ':Attribute mora sadržati :size elemenata.',
    ],
    'string'               => ':Attribute mora biti string.',
    'timezone'             => ':Attribute mora biti validna vremenska zona.',
    'unique'               => ':Attribute je već zauzet.',
    'uploaded'             => ':Attribute nije uspelo da se uploaduje.',
    'url'                  => ':Attribute nije validnog formata.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
