<?php

return [
    'repositories' => [
        'SleepingOwlAdmin/site' => [
            'actions' => [
                'push' => 'updateSite.sh',
            ],
        ],
        'SleepingOwlAdmin/docs' => [
            'actions' => [
                'push' => 'updateDocs.sh',
            ],
        ],
    ]
];