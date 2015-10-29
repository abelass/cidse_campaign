<?php
/**
 * Fonctions du plugin Four Steps for the Planet
 *
 * @plugin     Four Steps for the Planet
 * @copyright  2015
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Fourstepsforplanet\Fonctions
 */


if (!defined('_ECRIRE_INC_VERSION'))
  return;

/**
 * 
 * Permet de charger les définitions dans un squelettes
 * @param  string $type type de définition à retourner
 * @return mixed       String ou array de définitions
 */

function fsp_definitions($type) {
  $definitions = charger_fonction('fsp_definitions','inc');
  return $definitions($type);
}
