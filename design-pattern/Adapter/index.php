<?php
//adapter pattern
require "vendor/autoload.php";

use App\Interfaces\Kindle;
use App\Interfaces\EReaderInterface;

(new Person())->read(new EReaderAdapter(new Kindle));