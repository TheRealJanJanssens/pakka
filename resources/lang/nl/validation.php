<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | the following language lines contain the default errof messages used by
    | the validatof class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute moet be accepted.',
    'active_url'           => ':attribute is geen geldige URL.',
    'after'                => ':attribute moet een datum zijn na :date.',
    'after_or_gelijk zijn'       => ':attribute moet een datum zijn na of gelijk zijn als :date.',
    'alpha'                => ':attribute mag alleen letters bevatten.',
    'alpha_dash'           => ':attribute mag alleen letters, nummers, streepjes en underscores bevatten.',
    'alpha_num'            => ':attribute mag alleen letters en nummers bevatten.',
    'array'                => ':attribute moet een array zijn.',
    'before'               => ':attribute moet een datum zijn voor :date.',
    'before_or_gelijk zijn'      => ':attribute moet een datum zijn voor of gelijk zijn als :date.',
    'between'              => [
        'numeric' => ':attribute moet tussen :min en :max zijn.',
        'file'    => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string'  => ':attribute moet tussen :min en :max tekens zijn.',
        'array'   => ':attribute moet have between :min en :max items.',
    ],
    'boolean'              => ':attribute veld moet be true of false.',
    'confirmed'            => ':attribute confirmation does niet match.',
    'date'                 => ':attribute is niet a valid date.',
    'date_formaat'         => ':attribute does niet match Het formaat :formaat.',
    'different'            => ':attribute en :other moet be different.',
    'digits'               => ':attribute moet be :digits digits.',
    'digits_between'       => ':attribute moet tussen :min en :max digits zijn.',
    'dimensions'           => ':attribute has ongeldig image dimensions.',
    'distinct'             => ':attribute veld has a duplicate value.',
    'email'                => ':attribute moet een geldig email address zijn.',
    'exists'               => 'Het selected :attribute is ongeldig.',
    'file'                 => ':attribute moet be a file.',
    'filled'               => ':attribute veld moet have a value.',
    'gt'                   => [
        'numeric' => ':attribute moet groter zijn dan :value.',
        'file'    => ':attribute moet groter zijn dan :value kilobytes.',
        'string'  => ':attribute moet groter zijn dan :value tekens.',
        'array'   => ':attribute moet have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => ':attribute moet groter dan of gelijk zijn :value.',
        'file'    => ':attribute moet groter dan of gelijk zijn :value kilobytes.',
        'string'  => ':attribute moet groter dan of gelijk zijn :value tekens.',
        'array'   => ':attribute moet have :value items of more.',
    ],
    'image'                => ':attribute moet een afbeelding zijn.',
    'in'                   => 'Het geselecteerd :attribute is ongeldig.',
    'in_array'             => ':attribute veld bestaat niet in :other.',
    'integer'              => ':attribute moet een getal zijn.',
    'ip'                   => ':attribute moet een geldig IP address zijn.',
    'ipv4'                 => ':attribute moet een geldig IPv4 address zijn.',
    'ipv6'                 => ':attribute moet een geldig IPv6 address zijn.',
    'json'                 => ':attribute moet een geldig JSON string zijn.',
    'lt'                   => [
        'numeric' => ':attribute moet kleiner zijn dan :value.',
        'file'    => ':attribute moet kleiner zijn dan :value kilobytes.',
        'string'  => ':attribute moet kleiner zijn dan :value tekens.',
        'array'   => ':attribute moet have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => ':attribute moet kleiner dan of gelijk zijn :value.',
        'file'    => ':attribute moet kleiner dan of gelijk zijn :value kilobytes.',
        'string'  => ':attribute moet kleiner dan of gelijk zijn :value tekens.',
        'array'   => ':attribute moet niet have more than :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute mag niet groter zijn dan :max.',
        'file'    => ':attribute mag niet groter zijn dan :max kilobytes.',
        'string'  => ':attribute mag niet groter zijn dan :max tekens.',
        'array'   => ':attribute mag niet have more than :max items.',
    ],
    'mimes'                => ':attribute moet be a file of type: :values.',
    'mimetypes'            => ':attribute moet be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute moet minstens :min zijn.',
        'file'    => ':attribute moet minstens :min kilobytes zijn.',
        'string'  => ':attribute moet minstens :min tekens zijn.',
        'array'   => ':attribute moet have at least :min items.',
    ],
    'niet_in'               => 'Het selected :attribute is ongeldig.',
    'niet_regex'            => ':attribute formaat is ongeldig.',
    'numeric'              => ':attribute moet een nummer zijn.',
    'present'              => ':attribute veld moet huidig zijn.',
    'regex'                => ':attribute formaat is ongeldig.',
    'required'             => ':attribute veld is verplicht.',
    'required_if'          => ':attribute veld is verplicht wanneer :other is :value.',
    'required_unless'      => ':attribute veld is verplicht unless :other is in :values.',
    'required_with'        => ':attribute veld is verplicht wanneer :values aanwezig is.',
    'required_with_all'    => ':attribute veld is verplicht wanneer :values aanwezig is.',
    'required_without'     => ':attribute veld is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => ':attribute veld is verplicht wanneer geen of :values aanwezig zijn.',
    'same'                 => ':attribute en :other moeten gelijk zijn.',
    'size'                 => [
        'numeric' => ':attribute moet :size zijn.',
        'file'    => ':attribute moet :size kilobytes zijn.',
        'string'  => ':attribute moet :size tekens zijn.',
        'array'   => ':attribute moet :size items bevatten.',
    ],
    'string'               => ':attribute moet een string zijn.',
    'timezone'             => ':attribute moet een geldig zone.',
    'unique'               => ':attribute is al in gebruik.',
    'uploaded'             => ':attribute failed to upload.',
    'url'                  => ':attribute formaat is ongeldig.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you mag specify custom validation messages fof attributes using the
    | convention "attribute.rule" to name Het lines. This makes it quick to
    | specify a specific custom language line fof a given attribute rule.
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
    | Het following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
