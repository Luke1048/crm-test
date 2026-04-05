<?php

return [
    'success' => [
        'ticket_created' => 'The ticket successfully created',
    ],
    'error' => [
        'email_required' => 'Email is required',
        'email_invalid' => 'Please enter a valid email address',
        'email_min' => 'Email must be at least :min characters',
        'email_max' => 'Email must not exceed :max characters',
        'email_exists' => 'Customer with this email does not exist',

        'subject_required' => 'Subject is required',
        'subject_min' => 'Subject must be at least :min characters',
        'subject_max' => 'Subject must not exceed :max characters',

        'message_required' => 'Message is required',
        'message_min' => 'Message must be at least :min characters',
        'message_max' => 'Message must not exceed :max characters',

        'ticket_created' => 'Ticket created successfully!',
        'validation_failed' => 'Validation failed',
    ]
];
