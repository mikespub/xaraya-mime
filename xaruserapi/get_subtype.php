<?php

 /**
  *  Get the name of a mime type 
  *
  *  @author Carl P. Corliss
  *  @author Jason Judge
  *  @access public
  *  @param  integer    subtypeId   the subtypeID of the mime subtype to lookup (optional)
  *  @param  integer    subtypeName the Name of the mime sub type to lookup (optional)
  *  returns array      An array of (subtypeId, subtypeName) or an empty array
  */
  
function mime_userapi_get_subtype($args)
{
    // Farm the query off.
    // No need to duplicate the database query here.
    $subtypes = xarModAPIfunc('mime', 'user', 'getall_subtypes', $args);

    if (empty($subtypes)) {
        // No matches.
        return array();
    }

    if (count($subtypes) > 1) {
        // Too many matches.
        // TODO: perhaps raise an error?
        return;
    }

    // There is a single subtype element - return just that element.
    return reset($subtypes);
}    
    
?>