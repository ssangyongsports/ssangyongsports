<?php
/**
 * Displays the section management frontend.
 *
 * PHP Version 5.6
 *
 * This Source Code Form is subject to the terms of the Mozilla Public License,
 * v. 2.0. If a copy of the MPL was not distributed with this file, You can
 * obtain one at http://mozilla.org/MPL/2.0/.
 *
 * @category  phpMyFAQ
 * @author    Timo Wolf <amna.wolf@gmail.com>
 * @copyright 2005-2018 phpMyFAQ Team
 * @license   http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link      https://www.phpmyfaq.de
 * @since     2018-09-20
 */

use phpMyFAQ\Filter;
use phpMyFAQ\User;
use phpMyFAQ\User\CurrentUser;

if (!defined('IS_VALID_PHPMYFAQ')) {
    $protocol = 'http';
    if (isset($_SERVER['HTTPS']) && strtoupper($_SERVER['HTTPS']) === 'ON') {
        $protocol = 'https';
    }
    header('Location: '.$protocol.'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
    exit();
}

if (!$user->perm->checkRight($user->getUserId(), 'editsection') &&
    !$user->perm->checkRight($user->getUserId(), 'delsection') &&
    !$user->perm->checkRight($user->getUserId(), 'addsection')) {
    exit();
}

// set some parameters
//$groupSelectSize = 10;
//$memberSelectSize = 7;
//$descriptionRows = 3;
//$descriptionCols = 15;
$defaultSectionAction = 'list';

// what shall we do?
// actions defined by url: section_action=
$groupAction = Filter::filterInput(INPUT_GET, 'section_action', FILTER_SANITIZE_STRING, $defaultSectionAction);
// actions defined by submit button
if (isset($_POST['section_action_deleteConfirm'])) {
    $groupAction = 'delete_confirm';
}
if (isset($_POST['cancel'])) {
    $groupAction = $defaultGroupAction;
}
