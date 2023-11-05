<?php
    return [
        App\Core\Route::get('|^user/register/?$|',                  'Main',                   'getRegister'),
        App\Core\Route::post('|^user/register/?$|',                 'Main',                   'postRegister'),
        App\Core\Route::get('|^user/login/?$|',                     'Main',                   'getLogin'),
        App\Core\Route::post('|^user/login/?$|',                    'Main',                   'postLogin'),
        App\Core\Route::get('|^user/logout/?$|',                    'Main',                   'getLogout'),
        App\Core\Route::get('|^book/([0-9]+)/?$|',                  'Book',                   'show'),
        App\Core\Route::post('|^search/?$|',                        'Book',                   'postSearch'),
        App\Core\Route::get('|^cart/?$|',                           'Cart',                   'show'),

        # API rute:
        App\Core\Route::get('|^api/title/([0-9]+)/?$|',             'ApiTitle',               'getTitleByCategoryId'),
        App\Core\Route::get('|^api/books/([0-9]+)/?$|',             'ApiBook',                'getBooksByPageNumber'),
        App\Core\Route::get('|^api/bookmarks/?$|',                  'ApiBookmark',            'getBookmarks'),
        App\Core\Route::get('|^api/bookmarks/add/([0-9]+)/?$|',     'ApiBookmark',            'addBookmark'),
        App\Core\Route::get('|^api/bookmarks/clear/?$|',            'ApiBookmark',            'clear'),
        App\Core\Route::post('|^api/title/add/$|',                  'ApiTitle',               'add'),

        # User role routes:
        App\Core\Route::get('|^user/profile/?$|',                   'UserDashboard',          'index'),
        App\Core\Route::get('|^user/addBook/?$|',                   'UserBook',               'getAddBook'),
        App\Core\Route::post('|^user/addBook/?$|',                  'UserBook',               'postAddBook'),

        # Admin role routes:
        App\Core\Route::get('|^admin/?$|',                          'AdminDashboard',         'index'),

        App\Core\Route::any('|^.*$|',                               'Main',                   'home')
    ];
