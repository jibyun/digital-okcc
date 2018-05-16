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
    // Message for General(Common)
    'common' => [
        'save' => 'Save',
        'cancel' => 'Cancel',
        'confirmation' => 'Confirmation',
        'dateformat' => 'YYYY-MM-DD',
    ],

    // Message for Auth
    'auth' => [
        'changepassword' => 'Change Password',
        'currentpassword' => 'Current Password',
        'newpassword' => 'New Password',
        'confirmpassword' => 'Confirm New Password',
        'firstloginmsg' => 'This is your first login.  Please change your password',
        'errorpasswordincorrct' => 'Your current password does not matches with the password you provided. Please try again.',
        'errorpasswordsame' => 'New Password cannot be same as your current password. Please choose a different password.',
        'changepasswordsuccess' => 'Password changed successfully!',



    ],

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
        'history_createtitle' => 'Create History',
        'history_updatetitle' => 'Update History',
        'history_add' => 'Add',
        'history_delete' => 'Delete',
        'history_edit' => 'Edit',
        'history_title' => 'Title',
        'history_startdate' => 'Start Date',
        'history_enddate' => 'End Date',
        'history_memo' => 'Details',
        'history_dateformat' => 'YYYY-MM-DD',
        // Member Visit
        'visit_createtitle' => 'Create Visitation',
        'visit_updatetitle' => 'Update Visitation',
        'visit_add' => 'Add',
        'visit_delete' => 'Delete',
        'visit_edit' => 'Edit',
        'visit_title' => 'Title',
        'visit_visited_at' => 'Date of Visitation',
        'visit_pastor' => 'Pastor of Visitation',
        'visit_memo' => 'Note of Visitation',
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
        'header_menu_test'      => 'Tests',
        'message_user'          => 'The LORD is the everlasting God, the Creator of the ends of the earth. He will not grow tired or weary, and his understanding no one can fathom. He gives strength to the weary and increases the power of the weak. Even youths grow tired and weary, and young men stumble and fall; but those who hope in the LORD will renew their strength. They will soar on wings like eagles; they will run and not grow weary, they will walk and not be faint.',
        'message_member'        => 'Unless the Lord builds the house, the builders labor in vain. Unless the Lord watches over the city, the guards stand watch in vain. In vain you rise early and stay up late, toiling for food to eat—for he grants sleep to[a] those he loves.',
        'message_finance'       => 'Do not store up for yourselves treasures on earth, where moths and vermin destroy, and where thieves break in and steal. 20 But store up for yourselves treasures in heaven, where moths and vermin do not destroy, and where thieves do not break in and steal. 21 For where your treasure is, there your heart will be also.',
        'message_inventory'     => 'You show that you are a letter from Christ, the result of our ministry, written not with ink but with the Spirit of the living God, not on tablets of stone but on tablets of human hearts. Such confidence we have through Christ before God. Not that we are competent in ourselves to claim anything for ourselves, but our competence comes from God.',
        'message_test'          => 'For through the law I died to the law so that I might live for God. I have been crucified with Christ and I no longer live, but Christ lives in me. The life I now live in the body, I live by faith in the Son of God, who loved me and gave himself for me. 21 I do not set aside the grace of God, for if righteousness could be gained through the law, Christ died for nothing!',
        'passage_user'          => 'Isaiah 40:28-31',
        'passage_member'        => 'Psalm 127:1-2',
        'passage_finance'       => 'Matthew 6:19-21',
        'passage_inventory'     => '2 Corinthians 3:3-5',
        'passage_test'          => 'Galatians 2 19-20',
        'side_users'            => 'Users',
        'side_pri_role'         => 'Privilege & Role',
        'goback_home'           => 'Go Back Home',
        'copyright2018'         => 'Copyright &copy; 2018 Ottawa Korean Community Church',
        'contact'               => 'Contact to Admin',
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
        'cell_organizer'        => 'Gooyeok Organizer',
        'dept_organizer'        => 'Department Organizer',
        'contact'               => 'Contact Form',
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
        'full_name'             => 'Full Name',
        'message'               => 'Message',
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
        'status_name'           => 'Church Member',
        'level_id'              => 'Level Id',
        'level_name'            => 'Baptism',
        'duty_id'               => 'Duty Id',
        'duty_name'             => 'Officer',
        'photo'                 => 'Photo',
        'primary'               => 'Householder',
        'register_at'           => 'Register At',
        'baptism_at'            => 'Baptism At',
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
        'send_btn'              => 'Send Email',
        'enable_input'          => 'Enable',
        'disable_input'         => 'Disable',
        'manager_input'         => 'Team Manager',
        'nomanager_input'       => 'Team Member',
    ],

    'adm_message' => [
        'success_title'         => 'SUCCESS!',
        'fail_title'            => 'FAILED!',
        'warn_title'            => 'WARNING!',
        'request'               => 'Request Status: ',
        'exception'             => 'Exception Status: ',
        'status_text'           => ' Status Text: ',
        'save_error'            => 'An unknown error occurred while saving.',
        'save_success'          => 'The item was successfully SAVED.',
        'send_success'          => 'The email was successfully sended to OKCC IT Administrator.',
        'delete_success'        => 'The item was successfully DELETED.',
        'arrange_error'         => 'An unknown error occurred while re-arranging display order.',
        'arrange_success'       => 'Display order was successfully re-arranged.',
        'nomore_add'            => 'There are no more data to add.',
        'nomore_delete'         => 'There are no more data to delete.',
        'select_member'         => 'Select a Member first!',
    ],
];
