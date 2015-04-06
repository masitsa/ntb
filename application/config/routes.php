<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

/*
*	Site Routes
*/

/*
*	Settings Routes
*/
$route['settings'] = 'admin/settings';
$route['dashboard'] = 'admin/index';

/*
*	Login Routes
*/
$route['login-admin'] = 'login/login_admin';
$route['logout-admin'] = 'login/logout_admin';

$route['user-signin'] = 'login/user_signin';

$route['logout-user'] = 'login/logout_user';
/*
*	Users Routes
*/
$route['all-users'] = 'admin/users';
$route['all-users/(:num)'] = 'admin/users/index/$1';
$route['add-user'] = 'admin/users/add_user';
$route['edit-user/(:num)'] = 'admin/users/edit_user/$1';
$route['delete-user/(:num)'] = 'admin/users/delete_user/$1';
$route['activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['deactivate-user/(:num)'] = 'admin/users/deactivate_user/$1';
$route['reset-user-password/(:num)'] = 'admin/users/reset_password/$1';
$route['admin-profile/(:num)'] = 'admin/users/admin_profile/$1';


/*
* agencies routes
*/ 

$route['all-agencies'] = 'admin/agency/index';
$route['all-agencies/(:num)'] = 'admin/agency/index/$1';
$route['add-agency'] = 'admin/agency/add_agency';
$route['edit-agency/(:num)'] = 'admin/agency/edit_agency/$1';
$route['delete-agency/(:num)'] = 'admin/agency/delete_agency/$1';
$route['activate-agency/(:num)'] = 'admin/agency/activate_agency/$1';
$route['deactivate-agency/(:num)'] = 'admin/agency/deactivate_agency/$1';



/*
* Event type routes
*/ 

$route['all-event-type'] = 'admin/event_type/index';
$route['all-event-type/(:num)'] = 'admin/event_type/index/$1';
$route['add-event-type'] = 'admin/event_type/add_event_type';
$route['edit-event-type/(:num)'] = 'admin/event_type/edit_event_type/$1';
$route['delete-event-type/(:num)'] = 'admin/event_type/delete_event_type/$1';
$route['activate-event-type/(:num)'] = 'admin/event_type/activate_event_type/$1';
$route['deactivate-event-type/(:num)'] = 'admin/event_type/deactivate_event_type/$1';



/*
* Countries routes
*/ 

$route['all-country'] = 'admin/country/index';
$route['all-country/(:num)'] = 'admin/country/index/$1';
$route['add-country'] = 'admin/country/add_country';
$route['edit-country/(:num)'] = 'admin/country/edit_country/$1';
$route['delete-country/(:num)'] = 'admin/country/delete_country/$1';
$route['activate-country/(:num)'] = 'admin/country/activate_country/$1';
$route['deactivate-country/(:num)'] = 'admin/country/deactivate_country/$1';


/*
*	site Routes
*/


$route['home'] = 'site/index';
$route['calender'] = 'site/calender';
$route['messages'] = 'site/messages';
$route['profile'] = 'site/profile';
$route['timeline'] = 'site/index';
$route['all-events'] = 'site/events';
$route['add-event'] = 'site/events/add_event';
$route['edit-event/(:num)'] = 'site/events/edit_event/$1';
$route['activate-event/(:num)'] = 'site/events/activate_event/$1';
$route['deactivate-event/(:num)'] = 'site/events/deactivate_event/$1';
$route['view-meeting/(:num)'] = 'site/view_event/$1';
$route['events/book-event/(:num)'] = 'site/book_event/$1';
$route['events/open-event/(:num)'] = 'site/open_event/$1';

$route['all-action-points'] = 'site/action_point/all_action_points';
$route['all-action-points/(:num)'] = 'site/action_point/all_action_points/$1';
$route['add-action-point/(:num)'] = 'site/action_point/add_meeting_action_point/$1';
$route['update-meeting-action-point/(:num)/(:num)'] = 'site/action_point/edit_meeting_action_point/$1/$2';
$route['add-meeting-action-point/(:num)'] = 'site/action_point/add_meeting_action_point/$1';
$route['delete-action-point/(:num)/(:num)'] = 'site/action_point/delete_action_point/$1/$2';
$route['activate-action-point/(:num)/(:num)'] = 'site/action_point/activate_action_point/$1/$2';
$route['deactivate-action-point/(:num)/(:num)'] = 'site/action_point/deactivate_action_point/$1/$2';



$route['edit-action-point/(:num)/(:num)'] = 'site/action_point/edit_action_point/$1/$2';

$route['all-attendees'] = 'site/attendee/all_attendees';
$route['all-attendees/(:num)'] = 'site/attendee/all_attendees/$1';
$route['add-attendee/(:num)'] = 'site/attendee/add_attendee/$1';
$route['add-meeting-attendee/(:num)'] = 'site/attendee/add_meeting_attendee/$1';
$route['edit-attendee/(:num)/(:num)'] = 'site/attendee/edit_attendee/$1/$2';
$route['update-meeting-attendee/(:num)/(:num)'] = 'site/attendee/edit_meeting_attendee/$1/$2';
$route['delete-attendee/(:num)/(:num)'] = 'site/attendee/delete_attendee/$1/$2';
$route['activate-attendee/(:num)/(:num)'] = 'site/attendee/activate_attendee/$1/$2';
$route['deactivate-attendee/(:num)/(:num)'] = 'site/attendee/deactivate_attendee/$1/$2';
$route['send-attendee-notification/(:num)/(:num)'] = 'site/attendee/send_attendee_notification/$1/$2';
$route['send-attendee-mass-notification/(:num)'] = 'site/attendee/send_attendee_mass_notification/$1';


$route['all-facilitators'] = 'site/facilitator/all_facilitators';
$route['all-facilitators/(:num)'] = 'site/facilitator/all_facilitators/$1';
$route['add-facilitator/(:num)'] = 'site/facilitator/add_facilitator/$1';
$route['add-meeting-facilitator/(:num)'] = 'site/facilitator/add_meeting_facilitator/$1';
$route['edit-facilitator/(:num)/(:num)'] = 'site/facilitator/edit_facilitator/$1/$2';
$route['delete-facilitator/(:num)/(:num)'] = 'site/facilitator/delete_facilitator/$1/$2';
$route['update-meeting-facilitator/(:num)/(:num)'] = 'site/facilitator/edit_meeting_facilitator/$1/$2';

$route['delete-meeting-facilitator/(:num)/(:num)'] = 'site/facilitator/delete_meeting_facilitator/$1/$2';
$route['activate-facilitator/(:num)/(:num)'] = 'site/facilitator/activate_facilitator/$1/$2';
$route['deactivate-facilitator/(:num)/(:num)'] = 'site/facilitator/deactivate_facilitator/$1/$2';
$route['deactivate_meeting_facilitator/(:num)'] = 'site/facilitator/deactivate_meeting_facilitator/$1';
$route['send-convenor-notification/(:num)/(:num)'] = 'site/facilitator/send_convenor_notification/$1/$2';
$route['send-convenor-mass-notification/(:num)'] = 'site/facilitator/send_convenor_mass_notification/$1';




/*
*	Account Routes
*/
$route['account'] = 'site/account/my_account';
$route['account/orders-list'] = 'site/account/orders_list';
$route['account/my-details'] = 'site/account/my_details';
$route['account/wishlist'] = 'site/account/wishlist';
$route['account/update-details'] = 'site/account/update_account';
$route['update-password'] = 'site/account/update_password';
$route['account/sign-out'] = 'login/logout_user';

$route['profile'] = 'site/profile/edit_profile';
$route['profilez'] = 'site/profile/profile_page';
/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['messages'] = 'site/messages/inbox';
$route['messages/(:any)'] = 'site/messages/view_message/$1';


$route['meetings/(:any)'] = 'social/index/$1';
$route['meeting-comments/(:num)'] = 'social/meeting_comments/$1';
$route['open-meetings/(:any)/(:num)'] = 'social/open_meeting/$1/$2';
$route['save-meeting-comment/(:num)'] ='social/save_meeting_comments/$1';

// meeting notes
$route['meeting-facilitators/(:num)'] = 'site/facilitator/meeting_facilitators/$1';
$route['meeting-attendees/(:num)'] = 'site/attendee/meeting_attendees/$1';
$route['save-meeting-agenda/(:num)'] = 'site/events/save_meeting_agenda/$1';
$route['save-meeting-notes/(:num)'] = 'site/events/save_meeting_notes/$1';
$route['meeting-action-points/(:num)'] = 'site/action_point/meeting_action_points/$1';


$route['meeting-attachments/(:num)'] = 'site/attachments/meeting_attachments/$1';
$route['delete-attachment/(:num)/(:num)'] = 'site/attachments/delete_attachment/$1/$2';
$route['activate-attachment/(:num)/(:num)'] = 'site/attachments/activate_attachment/$1/$2';
$route['deactivate-attachment/(:num)/(:num)'] = 'site/attachments/deactivate_attachment/$1/$2';
// end 



$route['assigned-tasks'] = 'site/assigned_tasks';
$route['tasks-to-review'] = 'site/tasks_to_review';
$route['upcoming-meetings'] = 'site/upcoming_meetings';
$route['my-statistics'] = 'site/my_statistics';
$route['send-other-notification/(:num)/(:num)/(:num)/(:num)'] = 'site/send_other_notification/$1/$2/$3/$4';
$route['mark-as-complete/(:num)'] = 'site/mark_as_complete/$1';
$route['send-for-review/(:num)/(:num)/(:num)'] = 'site/send_for_review/$1/$2/$3';
$route['assigned-tasks-notification'] = 'site/assigned_tasks_notification';