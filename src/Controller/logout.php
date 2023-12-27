<?php

/**
 */

use Symfony\Component\HttpFoundation\RedirectResponse;
session_start();

session_destroy();

return new RedirectResponse('/login');