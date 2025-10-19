<?php

/**
* WARNING, call this method only in the base directory,
* or else - undefined behavior (UB).
*/
function config_init() : void
{
  $_SESSION['config']['base_path'] = dirname($_SERVER['SCRIPT_NAME']);
}
