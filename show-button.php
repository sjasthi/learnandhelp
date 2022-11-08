<?php

function getButton() {
    if (isset($_COOKIE['username'])) {
        global $role;
        $username = $_COOKIE['username'];
        $label = 'Log Off ' . $username;
        $role = $_COOKIE['role'];
        $action = 'logoff.php';
    } else {
        global $role;
        $label = 'Log On';
        $action = 'loginAction.php';
    }

    echo '<form action="'.$action.'" method="post">
          <input class="login-button"  type="submit" value="' . $label . '"/>
      </form>';
}

?>
