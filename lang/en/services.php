<?php

declare(strict_types=1);

return [
    'v1' => [
        'create' => [
            'success' => 'Your service will be created in the background.',
            'failure' => 'Your are not authorized to create a service.',
        ],
        'update' => [
            'success' => 'We will update your service in the background.',
            'failure' => 'Your are able to update this service that you do not own.',
        ],
        'show' => [
            'failure' => 'Your are able to view this service that you do not own.',
        ],
        'delete' => [
            'success' => 'Your service will be deleted in the background.',
            'failure' => 'Your cannot delete a service that you do not own.',
        ],
    ],
];
