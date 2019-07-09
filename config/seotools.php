<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Tinele - Ensino, Aprendizagem e Ganhos Compartilhados", // set false to total remove
            'description'  => 'Plataforma de ensino a distância, Cresça sem sair de casa! Cursos 100% online, 24h por dia!', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['ensino','ead','estudo','cursos','educacao a distancia','aprendizagem','ganhos compartilhados'],
            'canonical'    => null, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'        => "Tinele - Ensino, Aprendizagem e Ganhos Compartilhados", // set false to total remove
            'description'  => 'Plataforma de ensino a distância, Cresça sem sair de casa! Cursos 100% online, 24h por dia!', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => 'Tinele',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
