<?php

return [
    '' => [
        'controller' => 'user',
        'action' => 'list'
    ],
    'user/create' => [
        'controller' => 'user',
        'action' => 'create',
    ],
    'user/edit/{id:\d+}' => [
        'controller' => 'user',
        'action' => 'edit',
    ],
    'user/delete/{id:\d+}' => [
        'controller' => 'user',
        'action' => 'delete',
    ],
];