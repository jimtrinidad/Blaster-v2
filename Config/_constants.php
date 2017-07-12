<?php

define('DS', 				DIRECTORY_SEPARATOR);
define('ROOT_DIR', 			dirname(dirname(__FILE__)));

define('SYSTEM_DIR', 		ROOT_DIR . DS . 'Core' . DS);
define('APPLICATION_DIR', 	ROOT_DIR . DS . 'Application' . DS);
define('MODULE_DIR', 		APPLICATION_DIR . 'Modules' . DS);
define('MODEL_DIR', 		APPLICATION_DIR . 'Models' . DS);
define('VENDORS_DIR', 		ROOT_DIR . DS . 'Vendors' . DS);
define('TEMP_DIR', 			ROOT_DIR . DS . '_tmp' . DS);