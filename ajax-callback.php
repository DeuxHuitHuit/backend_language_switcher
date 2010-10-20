<?php
/**
 * Script for changing a user's language (directly in the database)
 */

if (!$_REQUEST['action[save]']) die();
$username = $_REQUEST['fields[username]'];
$language = $_REQUEST['fields[language]'];
?>