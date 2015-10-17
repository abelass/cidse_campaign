<?php
/**
 * Options du plugin Four Steps for the Planet
 *
 * @plugin     Four Steps for the Planet
 * @copyright  2015
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Fourstepsforplanet\Options
 */


if (!defined('_ECRIRE_INC_VERSION'))
  return;

/**
 * Intervient au traitement du formulaire
 *
 * @pipeline formulaire_traiter
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function fourstepsforplanet_formulaire_traiter($flux) {
  $form = $flux['args']['form'];

  if ($form == 'joindre_document') {
    $id_document = $flux['data']['ids'][0];
    $flux['data']['redirect'] = generer_url_public("document","id_document=$id_document").$flux['data']['redirect'];
  }
  return $flux;
}