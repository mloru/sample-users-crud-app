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

    'accepted' => 'Il campo :attribute deve essere accettato.',
    'accepted_if' => 'Il campo :attribute deve essere accettato quando :other è :value.',
    'active_url' => 'Il campo :attribute non contiene un indirizzo email valido.',
    'after' => 'Il campo :attribute deve essere successivo a :date.',
    'after_or_equal' => 'Il campo :attribute deve essere successivo o uguale a :date.',
    'alpha' => 'Il campo :attribute può contenere solamente lettere.',
    'alpha_dash' => 'Il campo :attribute può contenere solamente lettere, numeri, trattini e trattini bassi.',
    'alpha_num' => 'Il campo :attribute può contenere solamente lettere e numeri.',
    'any_of' => 'Il campo :attribute non è valido.',
    'array' => 'Il campo :attribute deve essere un array.',
    'ascii' => 'Il campo :attribute deve contenere solo caratteri alfanumerici e simboli a byte singolo.',
    'before' => 'Il campo :attribute deve essere una data antecedente a :date.',
    'before_or_equal' => 'Il campo :attribute deve essere una data antecedente o uguale a :date.',
    'between' => [
        'array' => 'Il campo :attribute deve essere compreso tra :min e :max elementi.',
        'file' => 'Il campo :attribute deve essere compreso tra :min e :max kilobytes.',
        'numeric' => 'Il campo :attribute deve essere compreso tra :min e :max.',
        'string' => 'Il campo :attribute deve essere compreso tra :min e :max caratteri.',
    ],
    'boolean' => 'Il campo :attribute deve essere vero o falso.',
    'can' => 'Il campo :attribute contiene un valore non autorizzato.',
    'confirmed' => 'Il campo :attribute non corrisponde.',
    'contains' => 'In :attribute manca un valore richiesto.',
    'current_password' => 'La password inserita non è corretta.',
    'date' => 'Il campo :attribute non è una data valida.',
    'date_equals' => 'Il campo :attribute deve essere uguale a :date.',
    'date_format' => 'Il campo :attribute non corrisponde al formato :format.',
    'decimal' => 'Il campo :attribute deve avere :decimal decimali.',
    'declined' => 'Il campo :attribute deve essere rifiutato.',
    'declined_if' => 'Il campo :attribute deve essere rifiutato quando :other è :value.',
    'different' => 'Il campo :attribute e :other devono essere diversi.',
    'digits' => 'Il campo :attribute deve essere lungo :digits caratteri.',
    'digits_between' => 'Il campo :attribute deve essere compreso tra :min e :max cifre.',
    'dimensions' => 'Le dimensioni immagine di :attribute non sono valide.',
    'distinct' => 'Il campo :attribute contiene dei valori duplicati.',
    'doesnt_contain' => 'Il campo :attribute non deve contenere nessuno dei seguenti valori: :values.',
    'doesnt_end_with' => 'Il campo :attribute non deve finire con uno dei seguenti valori: :values.',
    'doesnt_start_with' => 'Il campo :attribute non deve cominciare con uno dei seguenti valori: :values.',
    'email' => 'Il campo :attribute deve essere un indirizzo email valido.',
    'ends_with' => 'Il campo :attribute deve finire con uno dei seguenti valori: :values.',
    'enum' => 'L\'elemento :attribute selezionato non è valido.',
    'exists' => 'L\'elemento :attribute selezionato non è valido.',
    'extensions' => 'Il campo :attribute deve avere una delle seguenti estensioni: :values.',
    'file' => 'Il campo :attribute deve essere un file.',
    'filled' => 'Il campo :attribute deve essere valorizzato.',
    'gt' => [
        'array' => 'Il campo :attribute deve contenere più di :value elementi.',
        'file' => 'Il campo :attribute deve essere più grande di :value kilobytes.',
        'numeric' => 'Il campo :attribute deve essere maggiore di :value.',
        'string' => 'Il campo :attribute deve contenere più di :value caratteri.',
    ],
    'gte' => [
        'array' => 'Il campo :attribute deve contenere almeno :value elementi.',
        'file' => 'Il campo :attribute deve essere maggiore o uguale a :value kilobytes.',
        'numeric' => 'Il campo :attribute deve essere maggiore o uguale di :value.',
        'string' => 'Il campo :attribute deve contenere almeno :value caratteri.',
    ],
    'hex_color' => 'Il campo :attribute deve essere un colore esadecimale valido.',
    'image' => 'Il campo :attribute deve essere un\'immagine.',
    'in' => 'Il campo :attribute selezionato non è valido.',
    'in_array' => 'Il campo :attribute non esiste in :other.',
    'in_array_keys' => 'Il campo :attribute deve contenere almeno una delle seguenti chiavi: :values.',
    'integer' => 'Il campo :attribute deve essere un intero.',
    'ip' => 'Il campo :attribute deve essere un indirizzo IP valido.',
    'ipv4' => 'Il campo :attribute deve essere un indirizzo IPv4 valido.',
    'ipv6' => 'Il campo :attribute deve essere un indirizzo IPv6 valido.',
    'json' => 'Il campo :attribute deve contenere una stringa JSON valida.',
    'list' => 'Il campo :attribute deve essere un elenco.',
    'lowercase' => 'Il campo :attribute deve essere minuscolo.',
    'lt' => [
        'array' => 'Il campo :attribute deve contenere meno di :value elementi.',
        'file' => 'Il campo :attribute deve essere più piccolo di :value kilobytes.',
        'numeric' => 'Il campo :attribute deve essere inferiore a :value.',
        'string' => 'Il campo :attribute deve contenere meno di :value caratteri.',
    ],
    'lte' => [
        'array' => 'Il campo :attribute deve contenere non più di :value elementi.',
        'file' => 'Il campo :attribute deve essere minore o uguale a :value kilobytes.',
        'numeric' => 'Il campo :attribute deve essere inferiore o uguale a :value.',
        'string' => 'Il campo :attribute deve contenere non più di :value caratteri.',
    ],
    'mac_address' => 'Il campo :attribute deve essere un indirizzo MAC valido.',
    'max' => [
        'array' => 'Il campo :attribute non può contenere più di :max elementi.',
        'file' => 'Il campo :attribute non può essere più grande di :max kilobytes.',
        'numeric' => 'Il campo :attribute non può essere superiore a :max.',
        'string' => 'Il campo :attribute non può essere più lungo di :max caratteri.',
    ],
    'max_digits' => 'Il campo :attribute non deve contenere più di :max caratteri.',
    'mimes' => 'Il campo :attribute deve contenere un file di tipo: :values.',
    'mimetypes' => 'Il campo :attribute deve contenere un file di tipo: :values.',
    'min' => [
        'array' => 'Il campo :attribute deve avere almeno :min elementi.',
        'file' => 'Il campo :attribute deve essere almeno :min kilobyte.',
        'numeric' => 'Il campo :attribute deve essere minimo :min.',
        'string' => 'Il campo :attribute deve contenere almeno :min caratteri.',
    ],
    'min_digits' => 'Il campo :attribute deve avere almeno :min caratteri.',
    'missing' => 'Il campo :attribute deve essere mancante.',
    'missing_if' => 'Il campo :attribute deve essere mancante se :other è :value.',
    'missing_unless' => 'Il campo :attribute deve essere mancante a meno che :other non sia :value.',
    'missing_with' => 'Il campo :attribute deve essere mancante quando :values è presente.',
    'missing_with_all' => 'Il campo :attribute deve essere mancante quando :values sono presenti.',
    'multiple_of' => 'Il campo :attribute deve essere un multiplo di :value.',
    'not_in' => 'Il campo :attribute selezionato non è valido.',
    'not_regex' => 'Il formato di :attribute non è valido.',
    'numeric' => 'Il campo :attribute deve essere un numero.',
    'password' => [
        'letters' => 'Il campo :attribute deve contenere almeno una lettera.',
        'mixed' => 'Il campo :attribute deve contenere almeno una lettera maiuscola e una minuscola.',
        'numbers' => 'Il campo :attribute deve contenere almeno un numero.',
        'symbols' => 'Il campo :attribute deve contenere almeno un simbolo.',
        'uncompromised' => 'Il campo :attribute compare in una fuga di dati. Scegli un altro :attribute.',
    ],
    'present' => 'Il campo :attribute deve essere presente.',
    'present_if' => 'Il campo :attribute deve essere presente quando :other è :value.',
    'present_unless' => 'Il campo :attribute deve essere presente a meno che :other non sia :value.',
    'present_with' => 'Il campo :attribute deve essere presente quando :values ​​è presente.',
    'present_with_all' => 'Il campo :attribute deve essere presente quando :values sono presenti.',
    'prohibited' => 'Il campo :attribute è proibito.',
    'prohibited_if' => 'Il campo :attribute è proibito quando :other è :value.',
    'prohibited_if_accepted' => 'Il campo :attribute è proibito quando :other è accettato.',
    'prohibited_if_declined' => 'Il campo :attribute è proibito quando :other è rifiutato.',
    'prohibited_unless' => 'Il campo :attribute è proibito a meno che :other non sia :values.',
    'prohibits' => 'Il campo :attribute proibisce a :other di essere presente.',
    'regex' => 'Il formato di :attribute non è valido.',
    'required' => 'Il campo :attribute è richiesto.',
    'required_array_keys' => 'Il campo :attribute deve contenere uno dei seguenti valori: :values.',
    'required_if' => 'Il campo :attribute è richiesto quando :other è :value.',
    'required_if_accepted' => 'Il campo :attribute è richiesto quando :other è accettato.',
    'required_if_declined' => 'Il campo :attribute è obbligatorio quando :other viene rifiutato.',
    'required_unless' => 'Il campo :attribute è richiesto salvo che :other sia in :values.',
    'required_with' => 'Il campo :attribute è richiesto quando :values è presente.',
    'required_with_all' => 'Il campo :attribute è richiesto quando sono presenti :values.',
    'required_without' => 'Il campo :attribute è richiesto quando :values non è presente.',
    'required_without_all' => 'Il campo :attribute è richiesto quanto nessuno di :values è presente.',
    'same' => 'Il campo :attribute e :other devono corrispondere.',
    'size' => [
        'array' => 'Il campo :attribute deve contenere :size elementi.',
        'file' => 'Il campo :attribute deve essere :size kilobytes.',
        'numeric' => 'Il campo :attribute deve essere :size.',
        'string' => 'Il campo :attribute deve essere di :size caratteri.',
    ],
    'starts_with' => 'Il campo :attribute deve cominciare con uno dei seguenti valori: :values.',
    'string' => 'Il campo :attribute deve essere una stringa.',
    'timezone' => 'Il campo :attribute deve essere un fuso orario valido.',
    'unique' => 'Il campo :attribute è già in uso.',
    'uploaded' => 'L\'upload di :attribute è fallito.',
    'uppercase' => 'Il campo :attribute deve essere maiuscolo.',
    'url' => 'Il campo :attribute deve essere un URL valido.',
    'ulid' => 'Il campo :attribute deve essere un ULID valido.',
    'uuid' => 'Il campo :attribute deve essere un UUID valido.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
