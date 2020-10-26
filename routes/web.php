<?php
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Discussion;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);

Route::get('{provider}/auth', [
    'uses' => 'SocialsController@auth',
    'as' => 'social.auth'
]);

Route::get('/{provider}/redirect', [
    'uses' => 'SocialsController@auth_callback',
    'as'   => 'social.callback'
]);

Route::get('discussion/{slug}', [
    'uses' => 'DiscussionsController@bestReply',
    'as' => 'discussion'
]);

Route::get('channel/{slug}', [
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);


Route::group(['middleware' => 'auth'], function () {
    Route::resource('channels', 'ChannelsController');

    Route::get('discussion/create/new', [
        'uses' => 'DiscussionsController@create',
        'as' => 'discussions.create'
    ]);

    Route::get('/inbox', [
        'uses' => 'ForumsController@inbox',
        'as' => 'inbox'
    ]);

    Route::patch('something/{id}', [
        'uses' => 'ChannelsController@update',
        'as' => 'something.update'
    ]);

    Route::post('discussion/store', [
        'uses' => 'DiscussionsController@store',
        'as' => 'discussions.store'
    ]);

    Route::post('/discussion/reply/{id}', [
        'uses' => 'DiscussionsController@reply',
        'as' => 'discussion.reply'
    ]);
    
    Route::get('/reply/like/{id}', [
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('/reply/unlike/{id}', [
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    Route::get('/reply/dislike/{id}', [
        'uses' => 'RepliesController@dislike',
        'as' => 'reply.dislike'
    ]);

    Route::get('/reply/undislike/{id}', [
        'uses' => 'RepliesController@undislike',
        'as' => 'reply.undislike'
    ]);

    Route::get('/discussions/edit/{slug}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);
    
    Route::post('/discussion/update/{id}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussions.update'
    ]);

    Route::get('/discussion/close/{id}', [
        'uses' => 'DiscussionsController@closeDiscussion',
        'as' => 'discussion.close'
    ]);

    Route::get('/discussion/open/{id}', [
        'uses' => 'DiscussionsController@openDiscussion',
        'as' => 'discussion.open'
    ]);

    Route::get('/reply/edit/{id}', [
        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'
    ]);

    Route::get('/reply/update/{id}', [
        'uses' => 'RepliesController@update',
        'as' => 'reply.update'
    ]);

    Route::get('/reply/delete/{id}', [
        'uses' => 'repliesController@delete',
        'as' => 'reply.delete'
    ]);

    Route::get('/controlpanel', function () {
        $users = User::all();
        $status = Discussion::where('state', 0)->get();
        return view('adminControlPanel')->with(compact('users', $users))->with(compact('status', $status));
    });

    Route::post('/controlpanel/promote/{id}', [
        'uses' => 'UsersController@promote',
        'as' => 'user.promote'
    ]);

    Route::post('/controlpanel/demote/{id}', [
        'uses' => 'UsersController@demote',
        'as' => 'user.demote'
    ]);


    Route::post('/controlpanel/block/{id}', [
        'uses' => 'UsersController@block',
        'as' => 'user.block'
    ]);

    Route::post('/controlpanel/unblock/{id}', [
        'uses' => 'UsersController@unblock',
        'as' => 'user.unblock'
    ]);

    Route::get('/controlpanel/view/{id}', [
        'uses' => 'DiscussionsController@viewAdmin',
        'as' => 'viewAdmin'
    ]);

    Route::post('/controlpanel/approve/{id}', [
        'uses' => 'DiscussionsController@discussionApproval',
        'as' => 'adminApprove'
    ]);

    Route::get('/pleasewait', function () {
        return view('pleasewait');
    });

    Route::get('/discussion/like/{id}', [
        'uses' => 'DiscussionsController@like',
        'as' => 'discussion.like'
    ]);

    Route::get('/discussion/unlike/{id}', [
        'uses' => 'DiscussionsController@unlike',
        'as' => 'discussion.unlike'
    ]);

    Route::get('/discussion/dislike/{id}', [
        'uses' => 'DiscussionsController@dislike',
        'as' => 'discussion.dislike'
    ]);

    Route::get('/discussion/undislike/{id}', [
        'uses' => 'DiscussionsController@undislike',
        'as' => 'discussion.undislike'
    ]);
});
