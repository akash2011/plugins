<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the Dashboard widget block.
 *
 * @link       http://softyardbd.com/
 * @since      1.0.3
 *
 * @package    Simple_Personal_Message
 * @subpackage Simple_Personal_Message/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

$dashboard = new Simple_Personal_Message_Admin('', '');

$messagelimit = get_option('spm_message_send_limit');

$total_sent = $dashboard->total_send();

$total_limit = ((int)$messagelimit[wp_get_current_user()->roles[0]] == 0) ? '&infin;' : (int)$messagelimit[wp_get_current_user()->roles[0]];

$total_remain = ($total_limit - $total_sent);

$margin = floor($total_limit * 85 / 100);

$status = '';

if ($total_sent >= $margin && $total_remain != 0) {

    $status = 'warning';

} else if ($total_remain == 0) {

    $status = 'error';

} else {

    $status = 'success';

}

?>

<div class="spm-dashboard-message">

    <div class="">
	<p class="counter"> <a href="admin.php?page=simple-personal-message">View Message</a> |                 <a href="admin.php?page=simple-personal-message-compose">Compose Message</a></p>

    </div>
  

</div>