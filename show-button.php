<?php

function getButton() {
    if (isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        $label = 'Log Off ' . $username;
        $action = 'logoff.php';
    } else {
        echo '<form action="create_account.php" method="post">
          <input class="login-button" type="submit" value="Create Account"/>
          </form>';
        $label = 'Log On';
        $action = 'loginAction.php';
    }
    echo '<form action="'.$action.'" method="post">
          <input class="login-button" type="submit" value="' . $label . '"/>
      </form>';
}

?>