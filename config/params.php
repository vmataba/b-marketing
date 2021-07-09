<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'modules' => [
        'payroll' => [
            'name' => 'Payroll',
            'active' => false
        ],
        'recruitment' => [
            'name' => 'Recruitment',
            'active' => false
        ]
    ],
    /*
     * Time in minutes of user inactivity, when this
     * time passes and user isn't performing any action
     * he will be quickly logged out
     */
    'sessionTimeout' => 5,
    /*
     * Maximum supported attachment size(MB) (For Only Job Application)
     */
    'maxAttachmentSize' => 1
];
