<?php

return [
  // When emails are sent who are they from
  send => [
      'from' => 'PureIntellect.Com Support Team',
      'signature' => '',
  ],


  // Active or Registered users ability to create Tickets
  // Unregistered users will be stored in user_email, all others will be stored in user via the user id
  'active_only' => false,

  'comments' => true,

  //Statistics and Reports
  'statistics'  => false,
]

?>
