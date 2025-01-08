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
 *    Search an array recursivly
 *
 *    This function will search an array recursivly  till it finds what it is looking for. An array
 *    within an array within an array within array is all good. It returns an array containing the
 *    index names from the outermost index to the innermost, all the way up to the needle, or FALSE
 *    if the needle was not found, example:
 *
 *         $foo['bar']['some']['indice'] = 'something';
 *         $indice = array_search_r('something', $foo);
 *
 *    this would yield an array like so:
 *         $indice = array(0 => 'bar', 1 => 'some', 2 => 'indice'),
 *
 *    which could then be used to reconstruct the location like so:
 *         for ($i = 0; $i < count($indice); $i++) {
 *             if (!$i) $var = '$foo';
 *             $var .= "[{$indice[$i]}]";
 *         }
 *     then you could access it like so:
 *         $$var = 'something else';
 *
 *
 * @author       Richard Sumilang      <richard@richard-sumilang.com> (original author)
 * @author       Carl P. Corliss       <carl.corliss@xaraya.com>
 * @param array $args
 * with
 *     string    $needle     What are you searching for?
 *     array     $haystack   What you want to search in
 * @return      array|false            array of keys or FALSE if not found.
 * @access        public
 */

function mime_userapi_array_search_r(array $args = [], $context = null)
{
    extract($args);

    static $indent = 0;
    static $match = false;

    if (!isset($needle) || (!isset($haystack) || !is_array($haystack))) {
        $indent--;
        return false;
    }

    foreach ($haystack as $key => $value) {
        if (is_array($value)) {
            $indent++;
            $match = mime_userapi_array_search_r(['needle' => $needle, 'haystack' => $value]);
        } else {
            if ($value === $needle) {
                $match[$indent] = $value;
            } else {
                $match = false;
            }
        }
        if ($match) {
            $match[$indent] = $key;
            break;
        }
    }
    $indent--;

    if ($indent <= 0) {
        if (is_array($match)) {
            array_reverse($match);
        }
    }
    return $match;
}
