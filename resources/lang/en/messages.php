<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by general purpose for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // Message for registration
    'registration' => [

        'gotohome' => 'Go to Home',
        'receivedregister' => 'Your request has been received and will be processed shortly.',
        'telephone' => 'Telephone',
        'signupmessage' => 'Please provide the information below and you will get an email once your request is approved',
        'toAdminSubject' => 'User Registration Request',
        'toAdminGreeting' => 'Hello!',
        // TODO: Need to update the message
        'toAdminFirstPart' => 'Here is the user registartion request',
        'toAdminLastPart' => 'Please process it as soon as possible.',
        'toAdminBodyName' => "Name: ",
        'toAdminBodyEmail' => "Email: ",
        'toAdminBodyPhone' => "Phone: ",
    ],

    // Message for MemberList
    'memberlist' => [
        'landingtitle' => 'Ottawa Korean Community Church'
    ],

    // Message for MemberDetail
    'memberdetail' => [
        'menu_basicinfo' => 'Basic Information',
        'menu_history' => 'History Information',
        'menu_visit' => 'Visit Information',
    ],

    // Top Menu
    'top_menu' => [
        'members' => 'Members',
        // TODO: remove later
        'member_details' => 'Member Details',
        'finance' => 'Finance',
        'inventory' => 'Inventories',

    ],

    // System log
    'log' => [
        'success_message'       => 'Successfully created a new log.',
        'error_message'         => 'Not allowed to create!'
    ],

    // Button String using Admin 
    'adm_button' => [
        'export'                => 'Export',
        'create_member'         => 'Register Member',
        'excel'                 => 'Excel (XLSX)',
        'pdf'                   => 'PDF',
        'png'                   => 'PNG (Image)',
        'json'                  => 'JSON',
        'create'                => 'Create',
        'order'                 => 'Make Diaplay Order',
        'register'              => 'Register User',
        'add_role'              => 'Add Roles',
        'clear_all'             => 'Clear All',
        'add_department'        => 'Add Child Department',
        'add_family'            => 'Add Family',
        'add_career'            => 'Add Career',
    ],

    // View title using Admin 
    'adm_title' => [
        'member'                => 'Member List',
        'category'              => 'Category List',
        'code'                  => 'Code List',
        'privilege'             => 'Privilege List',
        'role'                  => 'Role List',
        'user'                  => 'User List',
        'log'                   => 'Log View',
        'privilege_role'        => 'Configure Privileges',
        'department_tree'       => 'Configure Department Tree',
        'family_tree'           => 'Compose Family Relation',
        'member_dept'           => 'Manage Member Relation',
    ],
];
