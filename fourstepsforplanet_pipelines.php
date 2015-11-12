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
 * Intervient lors de la vérification du formulaire
 *
 * @pipeline formulaire_traiter
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function fourstepsforplanet_formulaire_verifier($flux) {
  $form = $flux['args']['form'];

  if ($form == 'joindre_document' AND !_request('exec')) {
    $files = isset($_FILES) ? $_FILES : $GLOBALS['HTTP_POST_FILES'];
    $definitions = charger_fonction('fsp_definitions', 'inc');
    $definitions = $definitions($type);
    $extensions = $definitions['video_extensions'];
    $size = $definitions['video_upload_max_poids'];

    foreach ($files as $file) {
      list($name, $extension) = explode('.', $file['name'][0]);
      if (!in_array(strtolower($extension), $extensions)) {
        $flux['data']['message_erreur'] = _T('fourstepsforplanet:upload_erreur_extension', array('extensions' => implode(', ', $extensions)));
      }
      if ($file['size'][0] > $size) {
        $flux['data']['message_erreur'] = _T('fourstepsforplanet:upload_erreur_size', array('size' => $size / 1000000));
      }
    }
  }
  return $flux;
}

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
    include_spip('action/zencoder_new_job');
    $id_document = $flux['data']['ids'][0];

    //Convert the video with zencoder
    zencoder_new_job($id_document);

    $flux['data']['redirect'] = '/' . generer_url_public("rubrique", "id_rubrique=5&id_document=$id_document") . $flux['data']['redirect'];
  }
  return $flux;
}
