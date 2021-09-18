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
  *  @param  integer    $typeId      the type ID of the mime type to attch subtypes to
  *  @param  string     $subtypeName the name of the subtype to add
  *  @param  string     $subtypeDesc the description of the subtype to add
  *  returns array      false on error, the sub type id otherwise
  */

function mime_userapi_add_subtype($args)
{
    extract($args);

    if (!isset($typeId)) {
        $msg = xarML(
            'Missing parameter [#(1)] for function [#(2)] in module [#(3)].',
            'typeId',
            'userapi_add_subtypes',
            'mime'
        );
        throw new Exception($msg);
    }

    if (!isset($subtypeName)) {
        $msg = xarML(
            'Missing parameter [#(1)] for function [#(2)] in module [#(3)].',
            'subtypeName',
            'userapi_add_subtype',
            'mime'
        );
        throw new Exception($msg);
    }

    if (!isset($subtypeDesc) || !is_string($subtypeDesc)) {
        $subtypeDesc = null;
    }

    // Get database setup
    $dbconn = xarDB::getConn();
    $xartable =& xarDB::getTables();

    // table and column definitions
    $subtype_table =& $xartable['mime_subtype'];
    $subtypeId     = $dbconn->genID($subtype_table);

    $sql = "INSERT
              INTO $subtype_table
                 (
                   id,
                   name,
                   type_id,
                   description
                 )
            VALUES (?, ?, ?, ?)";

    $bindvars = [$subtypeId, (string)$subtypeName, (int)$typeId, (string)$subtypeDesc];

    $result = $dbconn->Execute($sql, $bindvars);

    if (!$result) {
        return false;
    } else {
        return $dbconn->PO_Insert_ID($subtype_table, 'id');
    }
}
