<?php

return [
    'hook_secret' => env('GITHUB_HOOK_SECRET'),
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