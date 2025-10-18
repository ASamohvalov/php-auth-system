<?php

function config_init() : void
{
  $_SESSION['config']['base_path'] = dirname($_SERVER['SCRIPT_NAME']);
}
