<?php

return [
    'success' => [
        'delete_record' => 'deleted successfully.',
        'create_record' => 'successfully created',
        'update_record' => 'Updated successfully.',
        'changed_password' => 'Change password successfully.',
        'resend_mail' => 'Email has been resent.',
    ],

    'fail' => [
        'credentials_invalid' => 'Incorrect email address or password.',
        'account_expired' => 'Your account has expired.',
        'email_not_exist' => 'Email address does not exist in the system.',
        'resend_mail_failure' => 'Email could not be resent. Please wait three minutes.',
        'expired_url' => 'URL does not exist. Or the URL has expired.',
        'file_size_2mb' => 'Please select a file within 2MB.',
    ],

    'common' => [
        'forgot_password_title' => '[C-Shop] About resetting your password.',
        'verification_account_title' => '【C-Shop】Information on email authentication procedures.',
    ],

    'validation' => [
        'password_require' => 'Please enter at least 10 and 16 alphanumeric characters and symbols.',
        're_password_not_match' => 'The password and confirmation password are different.',
        'email_unique' => 'This email address already exists.',
    ],
];
