<?php

require_once 'contributionsearch.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contributionsearch_civicrm_config(&$config) {
  _contributionsearch_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contributionsearch_civicrm_xmlMenu(&$files) {
  _contributionsearch_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contributionsearch_civicrm_install() {
  _contributionsearch_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function contributionsearch_civicrm_postInstall() {
  _contributionsearch_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contributionsearch_civicrm_uninstall() {
  _contributionsearch_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contributionsearch_civicrm_enable() {
  _contributionsearch_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contributionsearch_civicrm_disable() {
  _contributionsearch_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contributionsearch_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contributionsearch_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contributionsearch_civicrm_managed(&$entities) {
  _contributionsearch_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contributionsearch_civicrm_caseTypes(&$caseTypes) {
  _contributionsearch_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function contributionsearch_civicrm_angularModules(&$angularModules) {
  _contributionsearch_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contributionsearch_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contributionsearch_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function contributionsearch_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contributionsearch_civicrm_navigationMenu(&$menu) {
  _contributionsearch_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'be.domusmedica.contributionsearch')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contributionsearch_civix_navigationMenu($menu);
} // */


// inject the CRM_Contributionsearch_Query() object to alter the
// contact query behaviour
function contributionsearch_civicrm_queryObjects(&$queryObjects, $type) {
  if ($type == 'Contact') {
    $queryObjects[] = new CRM_Contributionsearch_Query();
  }
}

// in the returning result also the column header must be replaced to reflect
// the contents of the column
function contributionsearch_civicrm_alterContent(&$content, $context, $tplName, &$object) {
  if ($object instanceof CRM_Contribute_Form_Search || $object instanceof CRM_Contribute_Page_Tab ) {
    $content = str_replace('Relatiegeschenk', 'Factuur', $content);
    $content = str_replace('<label>Bedankje verzonden?</label>', '<label>Factuur aangemaakt?</label>', $content);
  }
}
