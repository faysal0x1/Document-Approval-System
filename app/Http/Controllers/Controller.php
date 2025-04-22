<?php

namespace App\Http\Controllers;

use App\Traits\AjaxResponse;
use App\Traits\FlashMessages;
use App\Traits\NotificationHelper;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use AjaxResponse, FlashMessages, NotificationHelper, ValidatesRequests;
}
