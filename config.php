<?php

/**
* WARNING, call this method only in the base directory,
* or else - undefined behavior (UB).
*/
function config_init() : void
{
  // нужно для того чтобы хранить базовую директорию где распологается index.php
  // __DIR__ не подойдет тк локально localhost имеет поддиректории
  $_SESSION['config']['base_path'] = dirname($_SERVER['SCRIPT_NAME']);
}
