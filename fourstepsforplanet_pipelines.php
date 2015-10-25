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

  if ($form == 'joindre_document' AND !_request('exec')) {
    $id_document = $flux['data']['ids'][0];
    $flux['data']['redirect'] = generer_url_public("document","id_document=$id_document").$flux['data']['redirect'];
  }
  return $flux;
}

/**
 * Permet d’ajouter des contenus dans la partie <head> d’une page HTML.
 *
 * @pipeline formulaire_traiter
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function fourstepsforplanet_insert_head($flux){
  $flux .= "<script src='" . find_in_path('scripts/masonry.pkgd.min.js') ."' type='text/javascript'></script>\n";
  $flux .= "<script src='" . find_in_path('scripts/jquery.infinitescroll.min.js') ."' type='text/javascript'></script>\n";
  $flux .= "<script src='" . find_in_path('scripts/imagesloaded.pkgd.min.js') ."' type='text/javascript'></script>\n";
  $flux .= "<script src='" . find_in_path('scripts/masonryInit.js') ."' type='text/javascript'></script>\n";  return $flux;  
  }
