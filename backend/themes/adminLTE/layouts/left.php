<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Control Menu', 'options' => ['class' => 'header']],
                    ['label' => 'หมวดหมู่เนื้อหา', 'icon' => 'fa fa-folder', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/category-news/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/category-news'],],
                        ],
                    ],
                    ['label' => 'เนื้อหา', 'icon' => 'fa fa-newspaper-o', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/news/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/news'],],
                            ['label' => 'เพิ่มข้อมูลสำหรับลูกค้า', 'icon' => 'fa fa-plus-square', 'url' => ['/news/create-special'],],
                            ['label' => 'จัดการข้อมูลสำหรับลูกค้า', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/news/index-special'],],
                        ],
                    ],
                    ['label' => 'โลโก้ลูกค้า', 'icon' => 'fa fa-file-image-o', 'url' => '#',
                        'items' => [
//                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/banner/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/customer'],],
                        ],
                    ],
                    // ['label' => 'Category Article', 'icon' => 'fa fa-file-code-o', 'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Create', 'icon' => 'fa fa-file-code-o', 'url' => ['/category-article/create'],],
                    //         ['label' => 'Manage', 'icon' => 'fa fa-file-code-o', 'url' => ['/category-article'],],
                    //     ],
                    // ],
                    // ['label' => 'Article', 'icon' => 'fa fa-file-code-o', 'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Create', 'icon' => 'fa fa-file-code-o', 'url' => ['/article/create'],],
                    //         ['label' => 'Manage', 'icon' => 'fa fa-file-code-o', 'url' => ['/article'],],
                    //     ],
                    // ],
                    ['label' => 'แบนเนอร์', 'icon' => 'fa fa-file-image-o', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/banner/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/banner'],],
                        ],
                    ],
                    ['label' => 'โปรโมชั่น', 'icon' => 'fa fa-television', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/promotions/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/promotions'],],
                        ],
                    ],
                    // ['label' => 'โฆษณา', 'icon' => 'fa fa-television', 'url' => '#',
                    //     'items' => [
                    //         ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/ads/create'],],
                    //         ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/ads'],],
                    //     ],
                    // ],
                    ['label' => 'ป๊อปอัพ', 'icon' => 'fa fa-file-image-o', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/popup/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/popup'],],
                        ],
                    ],
                    ['label' => 'วีดีโอ', 'icon' => 'fa fa-youtube-play', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/video/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/video'],],
                        ],
                    ],
                    ['label' => 'ธนาคาร', 'icon' => 'fa fa-file-image-o', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/bank/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/bank'],],
                        ],
                    ],
                    ['label' => 'พาร์ทเนอร์', 'icon' => 'fa fa-handshake-o', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/partner/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/partner'],],
                        ],
                    ],
                    ['label' => 'สมาชิก', 'icon' => 'fa fa-users', 'url' => '#',
                        'items' => [
                            ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/member/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/member'],],
                        ],
                    ],
                    ['label' => 'โซเชียล', 'icon' => 'fa fa-share-alt', 'url' => '#',
                        'items' => [
                            // ['label' => 'เพิ่มข้อมูล', 'icon' => 'fa fa-plus-square', 'url' => ['/social/create'],],
                            ['label' => 'จัดการข้อมูล', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/social'],],
                        ],
                    ],
//                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'fa fa-share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Category News', 'icon' => 'fa fa-file-code-o', 'url' => ['/category-news'],],
//                            ['label' => 'News', 'icon' => 'fa fa-file-code-o', 'url' => ['/news'],],
//                            ['label' => 'Category Article', 'icon' => 'fa fa-file-code-o', 'url' => ['/category-article'],],
//                            ['label' => 'Article', 'icon' => 'fa fa-file-code-o', 'url' => ['/article'],],
//                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'fa fa-circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
