<?php

// Config for yuges/ownable

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for ownerships
     */
    'models' => [
        'owner' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
            'relation' => [
                'name' => 'owner',
            ],
            'observer' => Yuges\Ownable\Observers\OwnerObserver::class,
        ],
        'ownable' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'allowed' => [
                'classes' => [
                    # models...
                ],
            ],
            'relation' => [
                'name' => 'ownable',
            ],
            'observer' => Yuges\Ownable\Observers\OwnableObserver::class,
        ],
        'ownership' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'table' => 'ownerships',
            'class' => Yuges\Ownable\Models\Ownership::class,
            'relation' => [
                'name' => 'groupable',
            ],
            'observer' => Yuges\Ownable\Observers\OwnershipObserver::class,
        ],
    ],

    'actions' => [
        'sync' => Yuges\Groupable\Actions\SyncGroupsAction::class,
        'attach' => Yuges\Groupable\Actions\AttachGroupsAction::class,
        'detach' => Yuges\Groupable\Actions\DetachGroupsAction::class,
    ],
];
