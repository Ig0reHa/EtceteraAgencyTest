<?php
/**
 * Snap exceptions
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package SnapLib
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

if (!class_exists('DupProSnapLib_32BitSizeLimitException', false)) {

    class DupProSnapLib_32BitSizeLimitException extends Exception
    {
        
    }
}