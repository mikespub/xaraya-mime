<?php
/**
 * Mime Module
 *
 * @package modules
 * @subpackage mime module
 * @category Third Party Xaraya Module
 * @version 1.1.0
 * @copyright see the html/credits.html file in this Xaraya release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link http://www.xaraya.com/index.php/release/eid/999
 * @author Carl Corliss <rabbitt@xaraya.com>
 */
$modversion['name']           = 'mime';
$modversion['id']             = '999';
$modversion['version']        = '2.6.0';
$modversion['displayname']    = xarMLS::translate('Mime');
$modversion['description']    = 'Hook based module that returns the content-type of a given file.';
$modversion['credits']        = 'xardocs/credits.txt';
$modversion['help']           = 'xardocs/help.txt';
$modversion['changelog']      = 'xardocs/changelog.txt';
$modversion['license']        = 'xardocs/license.txt';
$modversion['official']       = true;
$modversion['author']         = 'Carl P. Corliss <carl.corliss@xaraya.com>';
$modversion['contact']        = 'http://www.xaraya.com/';
$modversion['admin']          = true;
$modversion['user']           = false;
$modversion['class']          = 'Utility';
$modversion['category']       = 'Content';
$modversion['securityschema'] = [];
$modversion['namespace']      = 'Xaraya\Modules\Mime';
$modversion['twigtemplates']  = true;
$modversion['dependencyinfo'] = [
    0 => [
        'name' => 'Xaraya Core',
        'version_ge' => '2.4.1',
    ],
];
