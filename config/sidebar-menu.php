<?php

return [
    [
        'name'      => 'MANAGE',
        'isHeader'  => true,
        'route'     => null,
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-users"></i><p>Users</p>',
        'isHeader'  => false,
        'route'     => 'admin.users.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-users"></i><p>Accounts</p>',
        'isHeader'  => false,
        'route'     => 'admin.accounts.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-edit"></i><p>Applications</p>',
        'isHeader'  => false,
        'route'     => 'admin.applications.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-music"></i><p>Music Bands</p>',
        'isHeader'  => false,
        'route'     => 'admin.musicBands.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-music"></i><p>Musicians</p>',
        'isHeader'  => false,
        'route'     => null,
        'children'  => [
            [
                'name'      => '<i class="nav-icon fa fa-cogs"></i><p>Manage</p>',
                'isHeader'  => false,
                'route'     => 'admin.musicians.index',
                'children'  => [],
            ],
            [
                'name'      => '<i class="nav-icon fa fa-music"></i><p>Musicians Profile Pictures</p>',
                'isHeader'  => false,
                'route'     => 'admin.musicianProfilePictures.index',
                'children'  => [],
            ],
            [
                'name'      => '<i class="nav-icon fa fa-video"></i><p>Musicians Videos</p>',
                'isHeader'  => false,
                'route'     => 'admin.musicianVideos.index',
                'children'  => [],
            ],
        ],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-music"></i><p>Music Albums</p>',
        'isHeader'  => false,
        'route'     => 'admin.musicAlbums.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-music"></i><p>Music Records</p>',
        'isHeader'  => false,
        'route'     => 'admin.musicRecords.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-language"></i><p>Languages</p>',
        'isHeader'  => false,
        'route'     => 'admin.languages.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fa fa-music"></i><p>Music Lyrics</p>',
        'isHeader'  => false,
        'route'     => 'admin.musicLyrics.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fas fa-edit"></i><p>Wallpapers</p>',
        'isHeader'  => false,
        'route'     => null,
        'children'  => [
            [
            'name'      => '<i class="nav-icon fa fa-cogs"></i><p>Manage</p>',
            'isHeader'  => false,
            'route'     => 'admin.wallpapers.index',
            'children'  => [],
            ],
            [
                'name'      => '<i class="nav-icon fa fa-music"></i><p>Wallpaper Categories</p>',
                'isHeader'  => false,
                'route'     => 'admin.wallpaperCategories.index',
                'children'  => [],
            ],
            [
                'name'      => '<i class="nav-icon fa fa-tags"></i><p>Wallpaper Tags</p>',
                'isHeader'  => false,
                'route'     => 'admin.wallpaperTags.index',
                'children'  => [],
            ],
        ],
    ],
    [
        'name'      => '<i class="nav-icon fas fa-edit"></i><p>Additional Specific Attributes</p>',
        'isHeader'  => false,
        'route'     => 'admin.additionalSpecificAttributes.index',
        'children'  => [],
    ],
    [
        'name'      => '<i class="nav-icon fas fa-edit"></i><p>App Additional Specific Values</p>',
        'isHeader'  => false,
        'route'     => 'admin.appAdditionalSpecificValues.index',
        'children'  => [],
    ],
];
