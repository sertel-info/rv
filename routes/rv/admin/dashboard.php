<?php

Route::get('/admin/get_dashboard_stats', 'DashboardController@getAdminDashboardStats')
				->name("admin.dashboard.get.stats");

Route::get('/admin/get_header_data', 'DashboardController@getAdminHeaderData')
				->name("admin.dashboard.get.header_data");