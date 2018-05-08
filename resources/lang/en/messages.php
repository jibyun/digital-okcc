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
        'landingtitle' => 'Ottawa Korean Community Church',
        'id' => 'ID',
        'name' => 'Name',
        'first_name' => 'First Name',
        'middle_name' => 'Middle Name',
        'last_name' => 'Last Name',
        'kor_name' => 'Korean Name',
        'dob' => 'DOB',
        'gender' => 'Gender',
        'email' => 'Email',
        'tel_home' => 'Tel (Home)',
        'tel_office' => 'Tel (Office)',
        'tel_cell' => 'Tel (Cell)',
        'household' => 'Householder',
        'address' => 'Address',
        'postal_code' => 'Postal Code',
        'photo' => 'Photo',
        'city' => 'City',
        'province' => 'Province',
        'country' => 'Country',
        'status' => 'Status',
        'level' => 'Level',
        'duty' => 'Duty',
        'department' => 'Department',
        'register_date' => 'Register Date',
        'baptism_date' => 'Baptism Date',
        'allmember' => 'All Member',
        'search_result' => 'Search Result',
        'toolbar_saveexcel' => 'Save as Excel',
        'toolbar_email' => 'Email',
        // Export
        'savetoexcel' => 'Save to Excel',
        'filename' => 'File name',
        'save' => 'Save',
        'cancel' => 'Cancel'
        
        

    ],

    // Message for MemberDetail
    'memberdetail' => [
        'menu_basicinfo' => 'Basic Information',
        'menu_history' => 'History Information',
        'menu_visit' => 'Visit Information',
        // Member History
        'history_add' => 'Add',
        'history_delete' => 'Delete',
        'history_edit' => 'Edit',
        'history_title' => 'Title',
        'history_startdate' => 'Start Date',
        'history_enddate' => 'End Date',
        'history_memo' => 'Details'
    ],

    // Top Menu
    'top_menu' => [
        'members' => 'Members',
        // TODO: remove later
        'member_details' => 'Member Details',
        'finance' => 'Finance',
        'inventory' => 'Inventories',
        'admin' => 'Admin Page',

    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by general purpose for various
    | messages in Admin programs that we need to display to the user. 
    |
    */

    // using in Admin Layout
    'adm_layout' => [
        // header
        'header_menu_user'      => 'Users',
        'header_menu_member'    => 'Members',
        'header_menu_finance'   => 'Finances',
        'header_menu_inventory' => 'Inventories',
        'side_users'            => 'Users',
        'side_pri_role'         => 'Privilege & Role',
    ],

    // using Admin System log 
    'log' => [
        'success_message'       => 'Successfully created a new log.',
        'error_message'         => 'Not allowed to create!'
    ],

    // Button String using Admin 
    'adm_button' => [
        'export'                => 'Save As',
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
        'signin'                => 'Sign In',
        'logout'                => 'Log Out',
    ],

    // Title using Admin 
    'adm_title' => [
        'title'                 => ':title List',
        'create'                => 'Create :name',
        'add'                   => 'Add :name',
        'edit'                  => 'Edit :name',
        'show'                  => 'Show :name',
        'delete'                => 'Delete :name',
        'order'                 => 'Make Display Order',
        'upload_photo'          => 'Upload Photo',
        'cell_organizer'        => 'Cell Organizer',
        'dept_organizer'        => 'Department Organizer',
    ],

    // using Admin table & CRUD
    'adm_table' => [
        'id'                    => 'Id',
        'category_name'         => 'Category Name',
        'category_kname'        => '카테고리명',
        'enable'                => 'Enable',
        'manager'               => 'Manager',
        'field_name'            => 'Field Name',
        'memo'                  => 'Memo',
        'order'                 => 'Sort Order',
        'sysmetic'              => 'Sysmetic',
        'code_kname'            => '코드명',
        'dept_id'               => 'Department Id',
        'dept_name'             => 'Department Name',
        'first_name'            => 'First Name',
        'middle_name'           => 'Middle Name',
        'last_name'             => 'Last Name',
        'kor_name'              => '성명',
        'dob'                   => 'Birthdate',
        'gender'                => 'Gender',
        'male'                  => 'Male',
        'female'                => 'Female',
        'email'                 => 'Email',
        'tel_home'              => 'Home Phone',
        'tel_cell'              => 'Cell Phone',
        'tel_office'            => 'Office Phone',
        'address'               => 'Address',
        'postal'                => 'Postal Code',
        'city_id'               => 'City Id',
        'city_name'             => 'City',
        'province_id'           => 'Province Id',
        'province_name'         => 'Province',
        'country_id'            => 'Country Id',
        'country_name'          => 'Country',
        'status_id'             => 'Status Id',
        'status_name'           => 'Status',
        'level_id'              => 'Level Id',
        'level_name'            => 'Level',
        'duty_id'               => 'Duty Id',
        'duty_name'             => 'Duty',
        'photo'                 => 'Photo',
        'primary'               => 'Householder',
        'register_at'           => 'Register',
        'baptism_at'            => 'Baptism',
        'child_id'              => 'Child Id',
        'child_name'            => 'Name',
        'relation_id'           => 'Relation Id',
        'relation_name'         => 'Relation',
        'dept_id'               => 'Department Id',
        'dept_name'             => 'Department',
        'position_id'           => 'Position Id',
        'position_name'         => 'Position',
        'start_at'              => 'Start Date',
        'finished_at'           => 'End Date',
        'updated_by'            => 'Updated by Id',
        'updated_by_name'       => 'Updated By',
        'privilege_id'          => 'Privilege Id',
        'privilege_name'        => 'Privilege',
        'role_id'               => 'Role Id',
        'role_name'             => 'Role',
        'member_id'             => 'Member Id',
        'member_name'           => 'Member',
        'user_id'               => 'User Id',
        'user_name'             => 'User',
        'created_at'            => 'Created',
        'code_id'               => 'Code Id',
        'code_name'             => 'Code',
        'start_date'            => 'Start Date',
        'end_date'              => 'End Date',
        'select_member'         => 'Select a Member',
        'select_privilege'      => 'Select a Privilege',
        'select_log'            => 'Select a Log',
        'select_user'           => 'Select a User',
        'select_one'            => 'Please Select One!',
        'select_city'           => 'Select a City',
        'select_province'       => 'Select a Province',
        'select_country'        => 'Select a Country',
        'select_status'         => 'Select a Member Status',
        'select_level'          => 'Select a Baptism Status',
        'select_duty'           => 'Select a Duty',
        'select_relation'       => 'Select a Relation',
        'select_department'     => 'Select a Department',
        'select_position'       => 'Select a Position',
        'from_ph'               => 'From: YYYY-MM-DD',
        'to_ph'                 => 'To: YYYY-MM-DD',
        'date_ph'               => 'YYYY-MM-DD',
        'parent_dept'           => 'Parent Department',
        'child_dept'            => 'Child Department',
        'parent_member'         => 'Householder',
        'child_member'          => 'Family Member',
        'confirm_mesg'          => 'Once deleted data can not be recovered.<br/>Do you want to really DELETE?',
        'fake_delete'           => 'In this case, the data will not be actually deleted .<br/>Do you want to really DELETE?',
        'unassigned_label'      => 'Unassigned Member',
        'assigned_label'        => 'Assigned Member',
        'allmember_label'       => 'OKCC Member',
        'checkif_householder'   => 'Check if Householder',
        'essential_field'       => 'Essential Field: Name, Gender, Phone number, ...',
        'date_field'            => 'Date Field: Birthdate, Baptism at, Register at, ...',
        'contact_field'         => 'Contact Field: Email, Home Phone, Cell Phone, ...',
        'address_field'         => 'Address Field: Postal Code, Street, City, ...',
        'status_field'          => 'Status Field: Member Status, Batism Status, ...',

        // components on table
        'edit_btn'              => 'Edit',
        'del_btn'               => 'Del',
        'clone_btn'             => 'Clone',
        'cancel_btn'            => 'Cancel',
        'close_btn'             => 'Close',
        'close_panel_btn'       => 'Close Panel',
        'delete_btn'            => 'Delete',
        'delete_member_btn'     => 'Delete Member',
        'save_btn'              => 'Save Changes',
        'upload_btn'            => 'Upload Image',
        'manager_btn'           => 'As a Manager',
        'member_btn'            => 'As a Member',
        'leave_btn'             => 'Leave',
        'enable_input'          => 'Enable',
        'disable_input'         => 'Disable',
        'manager_input'         => 'Team Manager',
        'nomanager_input'       => 'Team Member',
    ],
];
