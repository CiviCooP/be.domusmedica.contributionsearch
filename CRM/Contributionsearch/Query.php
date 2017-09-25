<?php

class CRM_Contributionsearch_Query {

  public function getFields(){
    return array();
  }

  public function setTableDependency(&$tables){

  }

  public function from($name, $mode, $side){
    return NULL;
  }

  public function getPanesMapper(&$panes){

  }

  public function select (&$query){
    $query->_select['product_name'] = 'if(length(civicrm_contribution.invoice_id)=8,civicrm_contribution.invoice_id,null) as `product_name`';
  }

  public function where (&$query){

  }

}