<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * PHP version 7
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  Component
 * @package   Special
 * @author    Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
 * @copyright 2020 Copyright (c) Ascendtis IT Solutions.
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id$
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 */
namespace App\Controller\Component;
use Cake\Controller\Component;

/**
 * Media Component
 *
 * @category Component
 * @package  Query
 * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     https://www.ascendtis.com/
 */

class MediaComponent extends Component
{
  public $components = ['Query', 'Vimeo', 'Special'];

  /**
   * Add Media
   * 
   * @return uuid
   */
  public function onAdd($file = [], $caption = null, $description = null) {
    if (isset($file)) {
      $media = [];
      $media['value'] = $file;
      $media['caption'] = $caption;
      $media['description'] = $description;
      $media['media_type'] = $this->_getMediaType($file->getClientMediaType());
      $resp = $this->Query->setData('Media', $media);
      return $resp;
    }
    return null;
  }

  private function _getMediaType($mimeType = null) {
    if (strpos($mimeType, 'image') >= 0 && strpos($mimeType, 'image') !== false) {
      return 'IMAGE';
    } else if (strpos($mimeType, 'video') >= 0 && strpos($mimeType, 'video') !== false) {
      return 'VIDEO';
    } else if (strpos($mimeType, 'application') >= 0 && strpos($mimeType, 'application') !== false) {
      return 'DOCUMENT';
    }
  }

}
?>