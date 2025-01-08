<?php

/**
 * @package modules\mime
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
 *
 * @author mikespub <mikespub@xaraya.com>
**/

namespace Xaraya\Modules\Mime;

use Xaraya\DataObject\Traits\UserApiInterface;
use Xaraya\DataObject\Traits\UserApiTrait;
use DataObjectFactory;
use DataObjectList;
use sys;

sys::import('modules.dynamicdata.class.traits.userapi');

/**
 * Class to handle the Mime User API
**/
class UserApi implements UserApiInterface
{
    use UserApiTrait;

    protected static MimeTypeDetector $detector;

    /**
     * Get mime type detector
     * @uses \sys::autoload()
     */
    public function getDetector()
    {
        if (!isset(static::$detector)) {
            sys::autoload();
            static::$detector = new MimeTypeDetector();
        }
        return static::$detector;
    }

    /**
     * Summary of checkFileType
     * @param string $filePath
     * @return string|null
     */
    public function checkFileType($filePath)
    {
        return static::getDetector()->checkFileType($filePath);
    }

    /**
     * Summary of getExtension
     * @param string $mimeType
     * @return string|null
     */
    public function getExtension($mimeType)
    {
        return static::getDetector()->getExtension($mimeType);
    }

    /**
     * Summary of getMimeTypes
     * @param array<string, mixed> $args
     * @return DataObjectList|null
     */
    public function getMimeTypes($args = [])
    {
        $objectlist = DataObjectFactory::getObjectList(['name' => 'mime_types'], $this->context);
        if (!empty($args['where'])) {
            DataObjectFactory::applyObjectFilters($objectlist, $args['where']);
            // count the items
            //$objectlist->countItems();
        }
        $objectlist->getItems();
        return $objectlist;
    }

    /**
     * Summary of getSubTypes
     * @param array<string, mixed> $args
     * @return DataObjectList|null
     */
    public function getSubTypes($args = [])
    {
        $objectlist = DataObjectFactory::getObjectList(['name' => 'mime_subtypes'], $this->context);
        if (!empty($args['where'])) {
            DataObjectFactory::applyObjectFilters($objectlist, $args['where']);
            // count the items
            //$objectlist->countItems();
        }
        $objectlist->getItems();
        return $objectlist;
    }

    /**
     * Summary of getExtensions
     * @param array<string, mixed> $args
     * @return DataObjectList|null
     */
    public function getExtensions($args = [])
    {
        $objectlist = DataObjectFactory::getObjectList(['name' => 'mime_extensions'], $this->context);
        if (!empty($args['where'])) {
            DataObjectFactory::applyObjectFilters($objectlist, $args['where']);
            // count the items
            //$objectlist->countItems();
        }
        $objectlist->getItems();
        return $objectlist;
    }

    /**
     * Summary of getMagic
     * @param array<string, mixed> $args
     * @return DataObjectList|null
     */
    public function getMagic($args = [])
    {
        $objectlist = DataObjectFactory::getObjectList(['name' => 'mime_magic'], $this->context);
        if (!empty($args['where'])) {
            DataObjectFactory::applyObjectFilters($objectlist, $args['where']);
            // count the items
            //$objectlist->countItems();
        }
        $objectlist->getItems();
        return $objectlist;
    }
}