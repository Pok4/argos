<?php
//Core & Template Events
$event_dispatcher[]= ""; //globalize

$dispatcher->subscribe('core_event_head_append', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_head_append'] .= $data;
}); 

$dispatcher->subscribe('core_event_after_header', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_header'] .= $data;
});

$dispatcher->subscribe('core_event_before_header', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_header'] .= $data;
});

$dispatcher->subscribe('core_event_after_slider', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_slider'] .= $data;
});

$dispatcher->subscribe('core_event_after_chat', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_chat'] .= $data;
});

$dispatcher->subscribe('core_event_before_left_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_left_menu'] .= $data;
});

$dispatcher->subscribe('core_event_after_left_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_left_menu'] .= $data;
});

$dispatcher->subscribe('core_event_before_right_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_right_menu'] .= $data;
});

$dispatcher->subscribe('core_event_after_right_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_right_menu'] .= $data;
});

$dispatcher->subscribe('core_event_after_news', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_news'] .= $data;
});

$dispatcher->subscribe('core_event_after_comments', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_comments'] .= $data;
});

$dispatcher->subscribe('core_event_before_footer', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_footer'] .= $data;
});

$dispatcher->subscribe('core_event_after_footer', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_footer'] .= $data;
}); 

$dispatcher->subscribe('core_event_inside_multipurpose_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_inside_multipurpose_menu'] .= $data;
});

$dispatcher->subscribe('core_event_before_dropbox', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_dropbox'] .= $data;
});

$dispatcher->subscribe('core_event_before_files', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_files'] .= $data;
}); 

$dispatcher->subscribe('core_event_before_upload_videos', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_before_upload_videos'] .= $data;
});

$dispatcher->subscribe('core_event_after_contact_description', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_after_contact_description'] .= $data;
}); 

$dispatcher->subscribe('core_event_inside_custom_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_inside_custom_menu'] .= $data;
});

$dispatcher->subscribe('core_event_inside_custom_w_menu', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_inside_custom_w_menu'] .= $data;
}); 

$dispatcher->subscribe('core_event_inside_head_ready_front', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_event_inside_head_ready_front'] .= $data;
}); 

//admin events
$dispatcher->subscribe('core_admin_event_ext_pages', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_ext_pages'] .= $data;
}); 

$dispatcher->subscribe('core_admin_event_custom_pages_ext', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_custom_pages_ext'] .= $data;
}); 

$dispatcher->subscribe('core_admin_event_after_home', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_after_home'] .= $data;
}); 

$dispatcher->subscribe('core_admin_event_before_home', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_before_home'] .= $data;
});

$dispatcher->subscribe('core_admin_event_inside_script_tag', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_inside_script_tag'] .= $data;
}); 

$dispatcher->subscribe('core_admin_event_after_jquery', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_after_jquery'] .= $data;
}); 

$dispatcher->subscribe('core_admin_event_head_append', function($data) {
  global $event_dispatcher;
  $event_dispatcher['template_admin_event_head_append'] .= $data;
}); 