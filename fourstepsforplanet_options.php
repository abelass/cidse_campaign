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
 * 
 * Surcharge pour permettre l'upload d'un document pour un visiteur anonyme
 * 
 * http://code.spip.net/@autoriser_joindredocument_dist
 *
 * @return bool
 */

function autoriser_joindredocument($faire, $type, $id, $qui, $opt) {
  include_spip('inc/config');
  $return = FALSE;
  $public = _request('exec') ? FALSE : TRUE;
  if( 
    !$public 
    AND (
          (
            $type=='article'
            OR in_array(table_objet_sql($type),explode(',',lire_config('documents_objets', '')))
          )
        AND (
          (
            $id>0
            AND autoriser('modifier', $type, $id, $qui, $opt)
          )
          OR (
            $id<0
            AND abs($id) == $qui['id_auteur']
            AND autoriser('ecrire', $type, $id, $qui, $opt)
          )
        )
      )
    OR (
      $public
      AND (
            $type=='article'
            OR in_array(table_objet_sql($type),explode(',',lire_config('documents_objets', '')))
        )
      )
    )
    {
      $return = TRUE;
    }
  
  return $return;
}

/**
 * 
 * Surcharge pour permettre l'upload d'un document pour un visiteur anonyme
 * Autoriser a associer des documents a un objet :
 * il faut avoir le droit de modifier cet objet
 * @param $faire
 * @param $type
 * @param $id
 * @param $qui
 * @param $opt
 * @return bool
 */
function autoriser_associerdocuments($faire, $type, $id, $qui, $opt){
  // cas particulier (hack nouvel objet)
  if ((intval($id)<0 AND $id==-$qui['id_auteur']) OR !_request('exec')){
    return true;
  }
  return autoriser('modifier',$type,$id,$qui,$opt);
}
