<?php

/*Call this Script for API Request*/

require 'creategame.php';
print_r(json_encode(Game::createGame()));





?>