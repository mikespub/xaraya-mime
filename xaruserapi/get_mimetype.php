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

/**
 *  Get the name of a mime type
 *
 *  @author Carl P. Corliss
 *  @access public
 *  @param  integer    subtypeId   the subtypeID of the mime subtype to lookup (optional)
 *  @param  integer    subtypeName the Name of the mime sub type to lookup (optional)
 *  returns array      An array of (subtypeId, subtypeName) or an empty array
 */

function mime_userapi_get_mimetype($args)
{
    extract($args);

    if (!isset($subtypeId) && !isset($subtypeName)) {
        $msg = xarML('No (usable) parameter to work with (#(1)::#(2)::#(3))', 'mime', 'userapi', 'get_subtype');
        throw new Exception($msg);
    }

    // Get database setup
    $dbconn = xarDB::getConn();
    $xartable     =& xarDB::getTables();

    $where = ' WHERE ';

    if (isset($subtypeId)) {
        $where .= ' xmstype.id = ' . $subtypeId;
    } else {
        $where .= " xmstype.name = '".strtolower($subtypeName)."'";
    }

    // table and column definitions
    $subtype_table =& $xartable['mime_subtype'];
    $type_table    =& $xartable['mime_type'];

    $sql = "SELECT xmtype.sname AS mimetype,
                   xmstype.name AS mimesubtype
              FROM $type_table AS xmtype, $subtype_table AS xmstype
            $where
               AND xmtype.id = xmstype.type_id";

    $result = $dbconn->Execute($sql);

    if (!$result || $result->EOF) {
        return;
    }

    $row = $result->GetRowAssoc(false);

    return $row['mimetype'] . '/' . $row['mimesubtype'];
}
