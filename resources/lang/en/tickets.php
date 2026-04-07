<?php

return [
    'success' => [
        'ticket_created' => 'The ticket successfully created',
        'ticket_updated' => 'The ticket status successfully updated',
    ],
    'error' => [
        'id_required' => 'Ticket ID is required',
        'id_integer' => 'Ticket ID must be a number',
        'id_not_found' => 'Ticket with this ID does not exist',


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

        'attachment_type' => 'Attachment must be a .txt or .jpg file',
        'attachment_max' => 'Attachment must not exceed :max MB',

        'status_required' => 'Ticket status is required',
        'status_invalid' => 'The selected ticket status is invalid',

        'ticket_created' => 'Ticket created successfully!',
        'validation_failed' => 'Validation failed',
    ]
];
