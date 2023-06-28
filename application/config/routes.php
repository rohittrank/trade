<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard/index';
$route['market-watch'] = 'market_watch/index';
$route['notification'] = 'Notification/index';
$route['action-ladger'] = 'action_ladger/index';
$route['active-position'] = 'Active_position/index';
$route['closed-position'] = 'closed_position/index';
$route['closed-position/closed-position-user'] = 'closed_position/closed_position_user';
$route['trading-clients'] = 'Trading_clients/index';
$route['trade'] = 'trades/index';
$route['trades/create-trades'] = 'trades/create';
$route['trades/close-trade-view'] = 'trades/close_trade_view';
$route['trades/trade-view'] = 'trades/trade_view';
$route['pending-orders'] = 'Pending_orders/index';
$route['pending-orders/create-pending-order'] = 'Pending_orders/create';
$route['pending-orders/pending-order-view'] = 'Pending_orders/order_view';
$route['funds'] = 'trader_funds/index';
$route['funds/new-fund'] = 'trader_funds/create';
$route['funds/fund-view'] = 'trader_funds/funds_view';
$route['user'] = 'user/index';
$route['user/create-user'] = 'user/create';
$route['accounts'] = 'accounts/index';
$route['setting'] = 'setting/index';
$route['trading-clients/create-trading-clients/(:num)'] = 'trading_clients/add_clients';
$route['trading-clients/create-trading-clients'] = 'trading_clients/add_clients';
$route['trading-clients/edit-trading-clients/(:num)'] = 'trading_clients/edit_clients/$1';
$route['change-user-password/(:num)'] = 'Trading_clients/change_user_password/$1';
$route['trading-clients/mcxusers-views'] = 'trading_clients/mcx_users_view';
$route['notification/add-notification'] = 'notification/add_notification';
$route['logout'] = 'login/logout';

// --trading dashboard route-- //
$route['contact-us'] = 'Trading/Trading/contact_us';
$route['logout'] = 'trading/trading/logout';
$route['explore'] = 'trading/tradedashboard/explore';
$route['portfolio'] = 'trading/tradedashboard/portfolio';
$route['watchlist'] = 'trading/tradedashboard/watchlist';
$route['trading'] = 'trading/trading';
$route['trades'] = 'trading/tradedashboard/trades';
$route['portfolio'] = 'trading/tradedashboard/portfolio';
$route['account'] = 'trading/tradedashboard/account';
$route['trading_clients/downloadPDF'] = 'Trading_clients/downloadPDF';
$route['trading_clients/downloadPDF'] = 'Trading_clients/downloadPDF';
$route['trading/(:any)'] = 'Trading/Tradedashboard/detail_watchlist/$1';
// $route['websocket'] = 'Trading/WebsocketController';
$route['websocket'] = 'Trading/Tradingssss/websocket';
$route['tradings'] = 'Trading/Tradingssss/index';

 