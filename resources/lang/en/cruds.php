<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'apps'           => [
            'title'          => 'Apps Users',
            'title_singular' => 'Apps User',
        ],
        'cms'             => [
            'title'          => 'CMS Users',
            'title_singular' => 'CMS User',
        ],
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'ec_fullname'                       => 'Full Name',
            'ec_fullname_helper'                => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'locale'                   => 'Locale',
            'locale_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'first_name' => 'First Name',
            'first_name_helper' => ' ',
            'last_name' => 'Last Name',
            'last_name_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'birth_date' => 'Birth Date',
            'birth_date_helper' => ' ',
            'phone' => 'Phone',
            'phone_helper' => ' ',
            'bio' => 'Bio',
            'bio_helper' => ' ',
            'background_image'         => 'Background Image',
            'background_image_helper'  => ' ',
            'avatar'                   => 'Avatar',
            'avatar_helper'            => ' ',
            'country_id'                   => 'Location',
            'country_id_helper'            => ' ',
            'currency_id'                   => 'Currency',
            'currency_id_helper'            => ' ',
            'phone_code'                   => 'Phone Code',
            'phone_code_helper'            => ' ',
            'is_notify_email'                   => 'Email Notification',
            'is_notify_email_helper'            => ' ',
            'is_notify_sms'                   => 'SMS Notifications',
            'is_notify_sms_helper'            => ' ',
            'is_notify_push'                   => ' Push Notifications',
            'is_notify_push_helper'            => ' ',
            'is_marketing'                   => 'Marketing',
            'is_marketing_helper'            => ' ',
            'ec_relationship'                       => 'Relationship',
            'ec_relationship_helper'                => ' ',
            'ec_main_pcode'                       => 'Contact Phone Code',
            'ec_main_pcode_helper'                => ' ',
            'ec_main_pnum'                       => 'Contact Number',
            'ec_main_pnum_helper'                => ' ',
            'ec_alt_pcode'                       => 'Alternative Phone Code',
            'ec_alt_pcode_helper'                => ' ',
            'ec_alt_pnum'                       => 'Alternative Contact Number',
            'ec_alt_pnum_helper'                => ' ',
            'ec_email'                       => 'Email',
            'ec_email_helper'                => ' ',


        ],
    ],
    'sport' => [
        'title'          => 'Sport',
        'title_singular' => 'Sport',
        'fields'         => [
            'id'                            => 'ID',
            'id_helper'                     => ' ',
            'code'                          => 'Code',
            'code_helper'                   => 'Unique value',
            'name'                          => 'Name',
            'name_helper'                   => ' ',
            'description'                   => 'Description',
            'description_helper'            => ' ',
            'creator'                       => 'Creator',
            'creator_helper'                => ' ',
            'max_player_per_team'           => 'Max Player Per Team',
            'max_player_per_team_helper'    => ' ',
            'min_player_per_team'           => 'Min Player Per Team',
            'min_player_per_team_helper'    => ' ',
            'is_require_choose_role'        => 'Is Require Choose Role',
            'is_require_choose_role_helper' => ' ',
            'icon'                          => 'Icon',
            'icon_helper'                   => ' ',
            'created_at'                    => 'Created at',
            'created_at_helper'             => ' ',
            'updated_at'                    => 'Updated at',
            'updated_at_helper'             => ' ',
            'deleted_at'                    => 'Deleted at',
            'deleted_at_helper'             => ' ',
            'col_player_per_team'           => 'Players per Team',
        ],
    ],
    'team' => [
        'title'          => 'Team',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Team Name',
            'name_helper'             => ' ',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'creator'                 => 'Team Owner',
            'creator_helper'          => ' ',
            'coach'                   => 'Coach',
            'coach_helper'            => ' ',
            'gender'                  => 'Gender',
            'gender_helper'           => ' ',
            'level_id'                   => 'Level',
            'level_id_helper'            => ' ',
            'oganization_name'        => 'Oganization Name',
            'oganization_name_helper' => ' ',
            'oganization_url'         => 'Oganization Url',
            'oganization_url_helper'  => ' ',
            'division'                => 'Division',
            'division_helper'         => ' ',
            'season'                  => 'Season',
            'season_helper'           => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'bio'              => 'Bio',
            'bio_helper'       => ' ',
            'team_avatar_image'              => 'Avatar',
            'team_avatar_image_helper'       => ' ',
            'team_background'              => 'Background',
            'team_background_helper'       => ' ',
            'age_group'              => 'Age Group',
            'age_group_helper'       => ' ',
            'org_role_id'              => 'Team owners role in this organization',
            'org_role_id_helper'       => ' ',
            'no' => 'No',
            'name_member' => 'Name',
            'role' => 'Role',
            'roster' => 'Roster',
            'status' => 'Status',
            'weight' => 'Roster Weight',
            'create_at' => 'Create at',
            'age' => 'Age Group',
            'total_member' => 'Total Member',
            'member_request' => 'Member request',
        ],
        'member' => [
            'title'          => 'Team Member',
            'fields' => [
                'player_role' => 'Player role',
                'jersey_number' => 'Jersey number',
                'status' => 'Status'
            ]
        ]
    ],
    'country' => [
        'title'          => 'Country',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'phone_code'        => 'Phone Code',
            'phone_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Event',
        'title_singular' => 'Event',
        'title_singular_sport' => 'Sport Event',
        'title_singular_session' => 'Session',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'event_type'              => 'Event Type',
            'event_type_helper'       => ' ',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'max_team'          => 'Max number of joiners',
            'max_team_helper'   => ' ',
            'max_player_per_team'         => 'Player Per Team',
            'max_number_join'         => 'Max number of joiners',
            'max_player_per_team_helper'  => ' ',
            'application_type'        => 'Application Type',
            'application_type_helper' => ' ',
            'start_date_time'         => 'Start Date Time',
            'start_date_time_helper'  => ' ',
            'end_date_time'           => 'End Date Time',
            'end_date_time_helper'    => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'user_joined'             => 'User joined',
            'user_joined_helper'      => ' ',
            'user_invited'            => 'User invited',
            'user_invited_helper'     => ' ',
            'team_joined'             => 'Team joined',
            'team_joined_helper'      => ' ',
            'team_invited'            => 'Team invited',
            'team_invited_helper'     => ' ',
            'title'                   => 'Sports Event Title',
            'title_session'                   => 'Session Title',
            'title_helper'     => ' ',
            // 'max_team'                => 'Max team',
            'caption'                 => 'Caption',
            'about'                   => 'About',
            'gender'                  => 'Gender',
            'start_age'               => 'Start age',
            'end_age'                 => 'End age',
            'location'                => 'Location',
            'caption'              => 'Post Caption',
            'caption_helper'       => ' ',
            'upload_photo'              => 'Upload Photo',
            'upload_photo_helper'       => ' ',
            'about'              => 'About the Game',
            'about_session'              => 'About the Session',
            'about_event'              => 'About the Event',
            'about_helper'       => ' ',
            'gender'              => 'Gender',
            'gender_helper'       => ' ',
            'location'              => 'Location',
            'location_helper'       => ' ',
            'is_public'              => 'Game Privacy',
            'is_public_helper'       => ' ',
            'age_group'              => 'Age Group',
            'age_group_helper'       => ' ',
            'is_set_role'              => 'Player Roles will be decided at the event',
            'is_set_role_sport'              => 'There’s no limit for team joiners',
            'is_set_role_helper'       => ' ',
            'is_paid'              => 'This event will be free for all',
            'is_paid_helper'       => ' ',
            'fee'              => 'Charge Fee',
            'fee_helper'       => ' ',
            'lat'              => 'Latitude',
            'lat_helper'       => ' ',
            'long'              => 'Longitude',
            'long_helper'       => ' ',
            'mechanics'              => 'Event Mechanics',
            'mechanics_helper'       => ' ',
            'is_unlimit_max'              => 'There’s no limit for individual joiners',
            'is_unlimit_max_helper'       => ' ',
            'event_ownership'              => 'Event Ownership',
            'event_ownership_helper'       => ' ',
            'owner' => 'Owner',
            'title_management' => 'Title',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'last_update' => 'Last Update',
            'no_of_team' => 'No of team',
            'no_of_member' => 'No of member',
            'event_owner' => 'Event Ownership',
            'creator' => 'Event Owner',
            'post_caption' => 'Post caption',
            'number_of_team' => 'Number of teams',
            'no_player_per_team' => 'No. of Players per team',
            'player_role' => ' Player role ',
            'number_of_join' => 'Number of Joiners',
            'about_the_game' => 'About the game',
            'start_date_and_time' => 'Start date and time',
            'end_date_and_time' => 'End date and time',
            'game_privacy' => 'Game privacy',
            'invitation_code' => 'Invitation code',
            'is_public_event' => 'Event Privacy',
            'is_public_session' => 'Session Privacy',
            'creator' => 'Event owner',
            'creator_helper' => '',
            'currency' => 'Currency',
            'currency_helper' => '',


        ],
        'pickup' => [
            'title' => 'Pick-up game',
            'create' => 'Create new game',
        ],
        'session' => [
            'title' => 'Session event',
            'create' => 'Create new event'
        ],
        'sport' => [
            'title' => 'Sport event',
            'create' => 'Create new event'
        ],
        'league' => [
            'title' => 'League event',
            'create' => 'Create new event'
        ],
        'application_setup' => 'Application Setup',
        'game_detail' => 'Game Details',
        'event_detail' => 'Event Details',
        'invite_player' => 'Invite players',
        'invite_team' => 'Invite Teams',
        'player_list' => 'Player list',
        'event_mechanics' => 'Event mechanics',
        'player' => [
            'no' => 'No',
            'player_name' => 'Player name',
            'team' => 'Team',
            'position' => 'Position',
            'event' => 'Event',
            'joined' => 'Joined',
            'birth_date' => 'Birth date',
            'full_name' => 'Full name'
        ],

    ],
    'announcement' => [
        'title'          => 'Announcement',
        'title_singular' => 'Announcement',
        'fields'         => [
            'id'                      => 'ID',
            'creator'                 => 'Created by',
            'last_upated_by'          => 'Last Updated by',
            'type'                    => 'Type',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'title'                   => 'Title',
            'title_helper'             => '',
            'announcement_type_helper'=> ' ',
            'about'                   => 'Content',
            'announcementImage'       => 'Image',
            'title_singular_details'  => 'Announcement details',
            'status'                  => 'status',
            'start_date'              => 'Start Date',
            'start_date_helper'       => ' ',
            'end_date'                => 'End Date',
            'end_date_helper'         => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'status_helper'           => ' ',
            'about_helper'            => ' ',
            'action'                  => 'Actions',
        ],
        'session' => [
            'title' => 'Session event',
            'create' => 'Create new event'
        ],
        'sport' => [
            'title' => 'Sport event',
            'create' => 'Create new event'
        ],
        'league' => [
            'title' => 'League event',
            'create' => 'Create new event'
        ],
        'application_setup' => 'Application Setup',
        'game_detail' => 'Game Details',
        'event_detail' => 'Event Details',
        'invite_player' => 'Invite players',
        'player_list' => 'Player list',
        'event_mechanics' => 'Event mechanics'

    ],
    'content' => [
        'title'          => 'Contents',
        'title_singular' => 'Content',
    ],
    'system' => [
        'title'          => 'Systems',
        'title_singular' => 'System',
    ],
    'currency' => [
        'title' => 'Currency',
        'title_singular' => 'Currency',
        'create' => 'Add Currency',
        'fields' => [
            'id'                => 'ID',
            'name'              => "Name",
            'code'              => 'Code',
            'symbol'            => 'Symbol',
            'id_helper'         => ' ',
            'code_helper'       => ' ',
            'symbol_helper'     => ' ',
            'name_helper'       => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'created_by'        => 'Created_by',
            'created_by_helper' => ' ',

        ],
    ],
    'contactRelationship' => [
        'title' => 'Contact Relationship',
        'title_singular' => 'Contact Relationship',
        'create' => 'Add Contact Relationship',
        'fields' => [
            'id'                => 'ID',
            'name'              => "Name",
            'code'              => 'Code',
            'id_helper'         => ' ',
            'code_helper'       => ' ',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'creator_id'        => 'Created By',
            'creator_id_helper' => ' ',

        ],
    ],
    'skill' => [
        'title'          => 'Skill Level',
        'title_singular' => 'Skill Level',
        'add_permission' => 'Permission',
        'view_list'      => 'View list',
        'fields'         => [
            'id'                      => 'ID',
            'code'                    => 'Code',
            'name'                    => 'Name',
            'code_helper'             => '',
            'name_helper'             => '',
            'creator'                 => 'Created by',
            'type'                    => 'Type',
            'sport'                   => 'Sport',
            'sport_helper'            => ' ',
            'title'                   => 'Title',
            'title_helper'             => '',
            'announcement_type_helper'=> ' ',
            'about'                   => 'Content',
            'announcementImage'       => 'Image',
            'title_singular_details'  => 'Skill details',
            'status'                  => 'status',
            'start_date'              => 'Start Date',
            'start_date_helper'       => ' ',
            'end_date'                => 'End Date',
            'end_date_helper'         => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'status_helper'           => ' ',
            'about_helper'            => ' ',
            'action'                  => 'Actions',

        ],
    ],
    'venue' => [
        'title' => 'Venue',
        'my_venue' => 'My Venue',
        'fields' => [
            'id' => 'Id',
            'id_helper' => ' ',
            'owner' => 'Owner',
            'owner_helper' => ' ',
            'country' => 'Country',
            'country_helper' => ' ',
            'contact_info' => 'Contact info',
            'contact_info_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'address' => 'Address',
            'address_helper' => ' ',
            'lat' => 'Latitude',
            'lat_helper' => ' ',
            'long_helper' => ' ',
            'long' => 'Longitude',
            'phone_code' => 'Phone code',
            'phone_number' => 'Phone number',
            'phone_number_helper' => ' ',
            'phone_code_helper' => ' ',
            'bio_helper' => ' ',
            'bio' => 'Bio',
            'email' => 'Email',
            'email_helper' => ' ',
            'picture' => 'Picture',
            'picture_helper' => ' ',
            'location_helper' => ' ',
            'location' => 'Location',
            'sport' => 'Sport',
            'status' => 'Status',
            'work_day' => 'Workdays',
            'work_day_helper' => ' ',
            'rule' => 'Rules',
            'safety' => 'Safety',
            'open_hours_from' => 'Open hours from',
            'open_hours_to' => 'Open hours to',
            'banner' => 'Banner',
            'owner_info' => 'Owner info',
            'type' => 'Type',
            'currency' => 'Currency',
            'start_open_time' => 'Start open time',
            'end_open_time' => 'End open time',
        ]
    ],
    'organizationRole' => [
        'title' => 'Organization Role',
        'create' => 'add role',
        'fields' => [
            'id'                => 'ID',
            'no'                => 'NO.',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'phone_code'        => 'Phone Code',
            'phone_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_by'        => 'Created by',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'actions'           => 'Actions'
        ],

    ],
    'reservation' => [
        'title' => 'Reservation',
        'response' => 'Response',
        'fields' => [
            'event' => 'Event',
            'schedule' => 'Schedule',
            'requester' => 'Requester',
            'requested_at' => 'Requested at',
            'responding' => 'Responding',
            'action' => 'Action',
            'code' => 'Code',
            'court' => 'Court',
            'start_date' => 'Start date',
            'end_date' => 'End date',
        ],
    ],

    'team-block' => [
        'title' => 'Team Block',
        'create' => 'Team Block',
        'title_singular' => 'Team Block',
        'title_block' => 'User Blocked by',
        'fields' => [
            'no' => 'No',
            'account' => 'Account',
            'email' => 'Email',
            'blocked_at' => 'Blocked at'
        ],

    ],

    'member_request' => [
      'fields' => [
            'full_name' => 'Full name',
            'sports' => 'Sports',
            'email' => 'Email',
            'member_of_team' => 'Member of teams',
            'request_date' => 'Request date',
            'action' => 'Action',
      ],
    ],
    'venue-type' => [
        'title' => 'Venue Type',
        'create' => 'Venue Type',
        'title_singular' => 'Venue Type',
        'fields' => [
            'id'                => 'ID',
            'no'                => 'No',
            'code'              => 'Code',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'code_helper'       => ' ',
            'creator'           => 'Created by',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status_helper'     => ' ',
            'about_helper'      => ' ',
            'action'            => 'Actions',

        ],

    ],
];