<?php

/**
 *  Imports the mimelist array and adds it to the database
 *
 *  @author  Carl P. Corliss
 *  @access  public
 *  @param   array      $mimeList   List of mimetypes with their extensions (if any) and magics (if any)
 *  @returns boolean    true if successful importing into database, false otherwise.
 */

xarModAPILoad('mime','user');
 
function mime_userapi_import_mimelist( $args ) 
{
 
    extract( $args );

    foreach($mimeList as $mimeType => $mimeInfo) {
        
        /* 
            start off processing the mimetype and mimesubtype
            if niether of those exist, create them :)
        */
        $mimeType = explode('/', $mimeType);
        
        $typeInfo = xarModAPIFunc('mime','user','get_type', array('typeName' => $mimeType[0]));
        if (!isset($typeInfo['typeId'])) {
            $typeId = xarModAPIFunc('mime','user','add_type', array('typeName' => $mimeType[0]));
        } else {
            $typeId =& $typeInfo['typeId'];
        }
        
        $subtypeInfo = xarModAPIFunc('mime','user','get_subtype', array('subtypeName' => $mimeType[1]));
        if (!isset($subtypeInfo['subtypeId'])) {
            $subtypeId = xarModAPIFunc('mime', 'user', 'add_subtype', 
                                        array('subtypeName' => $mimeType[1], 
                                              'typeId'      => $typeId));
        } else {
            $subtypeId =& $subtypeInfo['subtypeId'];
        }
        
        if (isset($mimeInfo['extensions']) && count($mimeInfo['extensions'])) {
            foreach($mimeInfo['extensions'] as $extension) {
                $extensionInfo = xarModAPIFunc('mime', 'user', 'get_extension', 
                                                array('extensionName' => $extension));
                if (!isset($extensionInfo['extensionId'])) {
                    $extensionId = xarModAPIFunc('mime','user','add_extension', 
                                   array('subtypeId'     => $subtypeId,
                                         'extensionName' => $extension));
                } else {
                    $extensionId = $extensionInfo['extensionId'];
                }
            }
        }
        
        if (isset($mimeInfo['needles']) && count($mimeInfo['needles'])) {
            foreach($mimeInfo['needles'] as $magicNumber => $magicInfo) {
                $info = xarModAPIFunc('mime', 'user', 'get_magic', 
                                            array('magicValue' => $magicNumber));
                if (!isset($info['magicId'])) {
                    $magicId = xarModAPIFunc('mime', 'user', 'add_magic',
                                    array('subtypeId'   => $subtypeId,
                                          'magicValue'  => $magicNumber,
                                          'magicOffset' => $magicInfo['offset'],
                                          'magicLength' => $magicInfo['length']));
                } else {
                    $magicId = $info['magicId'];
                }
            }
        }
        
    }
    
    return TRUE;
} 
  
?>