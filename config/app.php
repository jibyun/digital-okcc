<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Maatwebsite\Excel\ExcelServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | System Admin email address
    |--------------------------------------------------------------------------
    |
    | This is the system admin email address.
    | It will be used sending email
    |
    */
    'SystemAdmin' => env('SYSTEM_ADMIN_EMAIL', 'it.help@okcc.ca'),

    /*
    |--------------------------------------------------------------------------
    | Member List Column info
    |--------------------------------------------------------------------------
    |
    | This is the JSON string to define the table columns in member list
    | You can edit it at https://jsoneditoronline.org/
    |
    */
    'MemberList_ColumnInfos' => '[
        {
          "field": "",
          "title": "",
          "checkbox": true,
          "visible": true
        },
        {
          "field": "eng_name",
          "title": "Name",
          "checkbox": false,
          "visible": true
        },
        {
          "field": "first_name",
          "title": "First Name",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "middle_name",
          "title": "Middle Name",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "last_name",
          "title": "Last Name",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "kor_name",
          "title": "Korean Name",
          "checkbox": false,
          "visible": true
        },
        {
          "field": "dob",
          "title": "BirthDate",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "gender",
          "title": "Gender",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_duty_id.txt",
          "title": "Officers",
          "checkbox": false,
          "visible": true
        },
        {
          "field": "email",
          "title": "Email",
          "checkbox": false,
          "visible": true
        },
        {
          "field": "tel_home",
          "title": "Home phone",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "tel_office",
          "title": "Office phone",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "tel_cell",
          "title": "Cell phone",
          "checkbox": false,
          "visible": true
        },
        {
          "field": "address",
          "title": "Address",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "postal_code",
          "title": "Postal Code",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_city_id.txt",
          "title": "City",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_province_id.txt",
          "title": "Province",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_country_id.txt",
          "title": "Country",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_status_id.txt",
          "title": "Church Member",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "code_by_level_id.txt",
          "title": "Baptism",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "register_date",
          "title": "Register Date",
          "checkbox": false,
          "visible": false
        },
        {
          "field": "baptism_date",
          "title": "Baptism Date",
          "checkbox": false,
          "visible": false
        }
      ]',
    
    /*
    |--------------------------------------------------------------------------
    | Member List Landing page item list
    |--------------------------------------------------------------------------
    |
    | This is the array of code.  It will be displayed in the memberList landing page
    | The array is parent-child structure.
    |
    */
    'MemberList_Bookmark' => '[{"title":"2","children":["20001","20002", "20003", "20004", "20005"]}, 
                              {"title":"5","children":["50001","50002", "50003", "50004", 
                              "50005", "50006", "50007", "50008", "50009", "50010"]}]',
                                  
    /*
    |--------------------------------------------------------------------------
    | Configuration used in Admin
    |--------------------------------------------------------------------------
    */
    'admin' => [
        'statusCategoryId'          => '1', // Member Status category id
        'officerCategoryId'         => '2', // Officer(Duty) category id
        'familyCategoryId'          => '3', // Family Relation category id
        'baptismCategoryId'         => '4', // Baptism Status category id
        'deptCategoryId'            => '5', // Department category id
        'cityCategoryId'            => '6', // Department category id
        'privinceCategoryId'        => '7', // Department category id
        'countryCategoryId'         => '8', // Department category id
        'cellCategoryId'            => '9', // 구역 category id
        'logCategoryId'             => '10', // Log category id
        'positionCategoryId'        => '11', // Position category id
        'cellStartId'               => '90101', // 구역 start id. cf. 교구 id: 90001 - 90100
        'cellManagerPositionId'     => '110103', // cell manager position id
        'cellMemberPositionId'      => '110104', // cell member position id
        'deptManagerPositionId'     => '110001, 110004, 110005', // DEPARTMENT manager position id (회장, 위원장, 부서장)
        'deptMemberPositionId'      => '110002, 110003, 110006, 110007', // DEPARTMENT member position id (총무, 회계, 부서집사, 위원)
        'logLogIn'                  => '100001', // INSERT log id
        'logLogOut'                 => '100002', // INSERT log id
        'logInsert'                 => '100003', // INSERT log id
        'logUpdate'                 => '100004', // INSERT log id
        'logDelete'                 => '100005', // INSERT log id
        //'deletedMember'             => '19999', // Deleted Member
        'memberStatus'              => '10001', // Member Status is 'Member'
        'laymanStatus'              => '20013', // Duty is 'No Officer'
        'unbaptizedStatus'          => '40005', // Level is 'Unbaptized'
    ],
    
];
