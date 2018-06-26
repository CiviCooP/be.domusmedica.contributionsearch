<?php
/**
 * Class to be used in the contributionsearch_civicrm_queryObjects hook
 *
 * @author Klaas Eikelboom <klaas.eikelboom@civicoop.org>
 * @date 25 sept 2017
 * @license AGPL-3.0
 */
class CRM_Contributionsearch_Query extends CRM_Contact_BAO_Query_Interface {

  public function &getFields(){
    return array();
  }

  public function setTableDependency(&$tables) {
  }

  public function from($name, $mode, $side) {
    return NULL;
  }

  public function getPanesMapper(&$panes) {
  }

  public function select(&$query) {
    Civi::log()->info('select keys ' . implode('; ', array_keys($query->_select)) . ' met waarden '
      . implode('; ', array_values($query->_select)));
    /* if a product_name is found (Welkomsgeschenk) put the contents of invoice id in it */
    /* the Domus Medica Invoice Id is 8 long, otherwise it is a hash generated by
       the payment processor - do not show */
    if(isset($query->_select['product_name'])) {
      $query->_select['product_name'] = 'civicrm_contribution.invoice_id AS product_name';
    }
  }

  public function where(&$query) {
    Civi::log()->info('where keys ' . implode('; ', array_keys($query->_where)) . ' met waarden '
      . implode('; ', array_values($query->_where)));
    foreach($query->_where[0] as $key=>$clause){
      if($clause=='civicrm_contribution.thankyou_date IS NOT NULL'){
        $query->_where[0][$key]='civicrm_contribution.invoice_id LIKE "%/%"';
      } elseif ($clause=='civicrm_contribution.thankyou_date IS NULL'){
        $query->_where[0][$key]='(civicrm_contribution.invoice_id NOT LIKE "%/%") OR (civicrm_contribution.invoice_id IS NULL)';
      }
    }
  }

}