<?php
Route::group(['as' => 'home.'], function() {
    Route::get('/', 'HomeController@index')->name('index')->middleware('guest');
    Route::get('/my/home', 'HomeController@dashboard')->name('dashboard')->middleware('auth');
    Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('auth');
     Route::post('/status', 'HomeController@status')->name('status');
});

Route::group(['as' => 'info.', 'prefix' => 'about'], function() {
    Route::get('/{article}', 'InfoController@index')->name('index');
});

Route::group(['as' => 'maintenance.', 'prefix' => 'maintenance'], function() {
    Route::get('/', 'MaintenanceController@index')->name('index');
    Route::post('/', 'MaintenanceController@authenticate')->name('authenticate');
    Route::get('/exit', 'MaintenanceController@exit')->name('exit');
});

Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function() {
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => 'guest'], function() {
        Route::group(['as' => 'login.', 'prefix' => 'log-in'], function() {
            Route::get('/', 'LoginController@index')->name('index');
            Route::post('/', 'LoginController@authenticate')->name('authenticate');
        });

        Route::group(['as' => 'register.', 'prefix' => 'sign-up'], function() {
            Route::get('/', 'RegisterController@index')->name('index');
            Route::get('/{referralCode}', 'RegisterController@index')->name('referred');
            Route::post('/', 'RegisterController@authenticate')->name('authenticate');
        });
    });
});

Route::group(['as' => 'account.', 'namespace' => 'Account', 'prefix' => 'account'], function() {
    Route::group(['as' => 'upgrade.', 'prefix' => 'upgrade'], function() {
        Route::post('/notify', 'UpgradeController@notify')->name('notify');

        Route::group(['middleware' => 'auth'], function() {
            Route::get('/', 'UpgradeController@index')->name('index');
            Route::get('/checkout/{product}', 'UpgradeController@checkout')->name('checkout');
            Route::get('/thank-you', 'UpgradeController@thankYou')->name('thank_you');
            Route::get('/canceled', 'UpgradeController@canceled')->name('canceled');
        });
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::group(['as' => 'verify.', 'prefix' => 'verify'], function() {
            Route::get('/', 'VerifyController@index')->name('index');
            Route::get('/confirm/{code}', 'VerifyController@confirm')->name('confirm');
            Route::post('/send', 'VerifyController@send')->name('send');
        });

        Route::group(['as' => 'banned.', 'prefix' => 'account-suspended'], function() {
            Route::get('/', 'BannedController@index')->name('index');
            Route::post('/', 'BannedController@reactivate')->name('reactivate');
        });

        Route::group(['as' => 'character.', 'prefix' => 'avatar/edit'], function() {
            Route::get('/', 'CharacterController@index')->name('index');
            Route::post('/regenerate', 'CharacterController@regenerate')->name('regenerate');
            Route::get('/inventory', 'CharacterController@inventory')->name('inventory');
            Route::get('/wearing', 'CharacterController@wearing')->name('wearing');
            Route::post('/update', 'CharacterController@update')->name('update');
        });

        Route::group(['as' => 'discord.', 'prefix' => 'discord'], function() {
            Route::get('/', 'DiscordController@index')->name('index');
            Route::post('/', 'DiscordController@generate')->name('generate');
        });

        Route::group(['as' => 'settings.', 'prefix' => 'account-settings'], function() {
            Route::get('/', 'SettingsController@index');
            Route::get('/{category}', 'SettingsController@index')->name('index');
            Route::post('/', 'SettingsController@update')->name('update');
        });

        Route::group(['as' => 'friends.', 'prefix' => 'friends'], function() {
            Route::get('/', 'FriendsController@index')->name('index');
            Route::post('/', 'FriendsController@update')->name('update');
        });

        Route::group(['as' => 'inbox.', 'prefix' => 'inbox'], function() {
            Route::get('/', 'InboxController@index');
            Route::get('/notifications', 'InboxController@notifications');
            Route::get('/{category}', 'InboxController@index')->name('index');
            Route::get('/view/{id}', 'InboxController@message')->name('message');
            Route::get('/new/{type}/{id}', 'InboxController@new')->name('new');
            Route::post('/create', 'InboxController@create')->name('create');
        });

        Route::group(['as' => 'money.', 'prefix' => 'money'], function() {
            Route::get('/', 'MoneyController@index');
            Route::get('/{category}', 'MoneyController@index')->name('index');
        });

        Route::group(['as' => 'trades.', 'prefix' => 'trades'], function() {
            Route::get('/', 'TradesController@index');
            Route::get('/{category}', 'TradesController@index')->name('index');
            Route::get('/view/{id}', 'TradesController@view')->name('view');
            Route::get('/send/{username}', 'TradesController@send')->name('send');
            Route::post('/process', 'TradesController@process')->name('process');
        });

        Route::group(['as' => 'invite.', 'prefix' => 'invite'], function() {
            Route::get('/', 'InviteController@index')->name('index');
        });

        Route::group(['as' => 'promocodes.', 'prefix' => 'code-redemption'], function() {
            Route::get('/', 'PromocodesController@index')->name('index');
            Route::post('/redeem', 'PromocodesController@redeem')->name('redeem');
        });
    });
});

Route::group(['as' => 'report.', 'prefix' => 'report', 'middleware' => 'auth'], function() {
    Route::get('/{type}/{id}', 'ReportController@index')->name('index');
    Route::get('/thank-you', 'ReportController@thankYou')->name('thank_you');
    Route::post('/submit', 'ReportController@submit')->name('submit');
});

Route::group(['as' => 'games.'], function() {
    Route::get('/client', 'GamesController@download')->name('download');
    Route::get('/sets', 'GamesController@creations')->name('creations')->middleware('auth');

    Route::group(['prefix' => 'play'], function() {
        Route::get('/', 'GamesController@index')->name('index');
        Route::get('/create', 'GamesController@create')->name('create')->middleware('auth');
        Route::get('/{id}', 'GamesController@view')->name('view');
        Route::get('/{id}/edit', 'GamesController@edit')->name('edit')->middleware('auth');
        Route::post('/update', 'GamesController@update')->name('update')->middleware('auth');
    });
});

Route::group(['as' => 'catalog.', 'prefix' => 'store'], function() {
    Route::get('/{type}', 'CatalogController@index')->name('index');
    Route::get('/{id}/{slug}', 'CatalogController@item')->name('item');
    Route::get('/{id}/{slug}/edit', 'CatalogController@edit')->name('edit')->middleware('auth');
    Route::post('/update', 'CatalogController@update')->name('update')->middleware('auth');
    Route::post('/purchase', 'CatalogController@purchase')->name('purchase')->middleware('auth');
    Route::post('/resell', 'CatalogController@resell')->name('resell')->middleware('auth');
    Route::post('/take-off-sale', 'CatalogController@takeOffSale')->name('take_off_sale')->middleware('auth');
});

Route::group(['as' => 'forum.', 'prefix' => 'forum'], function() {
    Route::get('/', 'ForumController@index')->name('index');
    Route::get('/search', 'ForumController@search')->name('search')->middleware('auth');
    Route::get('/topic/{id}/{slug}', 'ForumController@topic')->name('topic');
    Route::get('/thread/{id}', 'ForumController@thread')->name('thread');
    Route::get('/new/{type}/{id}', 'ForumController@new')->name('new')->middleware('auth');
    Route::post('/create', 'ForumController@create')->name('create')->middleware('auth');
    Route::get('/edit/{type}/{id}', 'ForumController@edit')->name('edit')->middleware('require_staff');
    Route::post('/edit', 'ForumController@update')->name('update')->middleware('require_staff');
    Route::get('/moderate/{type}/{action}/{id}', 'ForumController@moderate')->name('moderate')->middleware('require_staff');
});

Route::group(['as' => 'creator_area.', 'prefix' => 'creator-area', 'middleware' => 'auth'], function() {
    Route::get('/', 'CreatorAreaController@index')->name('index');
    Route::post('/create', 'CreatorAreaController@create')->name('create');
});

Route::group(['as' => 'users.'], function() {
    Route::group(['prefix' => 'users'], function() {
        Route::get('/search/{category}', 'UsersController@index')->name('index');
        Route::get('/search', 'UsersController@index');
    });

    Route::group(['prefix' => 'user/{username}'], function() {
        Route::get('/', 'UsersController@profile')->name('profile');
        Route::get('/friends', 'UsersController@friends')->name('friends');
        Route::get('/groups', 'UsersController@groups')->name('groups');
        Route::get('/backpack', 'UsersController@items')->name('items');
    });
});

Route::group(['as' => 'groups.', 'prefix' => 'groups'], function() {
    Route::get('/', 'GroupsController@index')->name('index');
    Route::get('/{id}/{slug}', 'GroupsController@view')->name('view');
    Route::get('/{id}/{slug}/manage', 'GroupsController@manage')->name('manage')->middleware('auth');
    Route::post('/update', 'GroupsController@update')->name('update')->middleware('auth');
    Route::post('/update-join-request', 'GroupsController@updateJoinRequest')->name('update_join_request')->middleware('auth');
    Route::post('/membership', 'GroupsController@membership')->name('membership')->middleware('auth');
    Route::post('/set-primary', 'GroupsController@setPrimary')->name('set_primary')->middleware('auth');
});

Route::group(['as' => 'badges.', 'prefix' => 'achievements'], function() {
    Route::get('/', 'BadgesController@index')->name('index');
});
