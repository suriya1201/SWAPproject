<?php
// NOTE: This code is not fully working code, but an example!

session_start();

// Check destroyed time-stamp
if (isset($_SESSION['destroyed'])
    && $_SESSION['destroyed'] < time() - 300) {
    // Should not happen usually. This could be attack or due to unstable network.
    // Remove all authentication status of this users session.
    remove_all_authentication_flag_from_active_sessions($_SESSION['userid']);
    throw(new DestroyedSessionAccessException);
}

$old_sessionid = session_id();

// Set destroyed timestamp
$_SESSION['destroyed'] = time(); // session_regenerate_id() saves old session data

// Simply calling session_regenerate_id() may result in lost session, etc.
// See next example.
session_regenerate_id();

// New session does not need destroyed timestamp
unset($_SESSION['destroyed']);

$new_sessionid = session_id();

echo "Old Session: $old_sessionid<br />";
echo "New Session: $new_sessionid<br />";

print_r($_SESSION);
?>