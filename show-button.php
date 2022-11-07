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
        echo '<form action="create_account.php" method="post">
          <input class="login-button" type="submit" value="Create Account"/>
          </form>';
        $label = 'Log On';
        $action = 'loginAction.php';
    }

    if ($role == 'admin') {
        echo '<form action="administration.php" method="post"> 
        <input class="login-button"  type="submit" value = "Administration"/>
        </form>';
    }
    echo '<form action="'.$action.'" method="post">
          <input class="login-button"  type="submit" value="' . $label . '"/>
      </form>';
}

?>
