<?php
    session_name('signup_session');
    session_start();

    session_unset();
    session_destroy();
?>