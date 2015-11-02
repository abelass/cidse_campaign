<?php
/**
 * Définitions du plugin Four Steps for the Planet
 *
 * @plugin     Four Steps for the Planet
 * @copyright  2015
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Fourstepsforplanet\Definitions
 */

if (!defined('_ECRIRE_INC_VERSION'))
  return;

/**
 * Gére des définitions de bases
 *
 * @param  string $type type de définition à retourner
 * @return mixed       String ou array de définitions
 */
function inc_fsp_definitions_dist($type = 'video_extensions') {
  $definitions = array(
    'video_extensions' => array('mp4','webm'),
    'video_upload_max_poids' => 5000000 //poids en bytes
    );
  
  if (!$type) return $definitions;
  else return $definitions[$type];
}
