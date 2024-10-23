<?php

use Core\Session;

Session::destroy();

header('location: /');
exit();