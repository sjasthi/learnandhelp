<?php

function getButton() {
    if (isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        $label = 'Log Off ' . $username;
        $action = 'logoff.php';
    } else {
        $label = 'Log On';
        $action = 'login.php';
    }
    echo '<form action="' . $action . '" method="post">
          <input class="login-button" type="submit" value="' . $label . '"/>
      </form>';
}

?>