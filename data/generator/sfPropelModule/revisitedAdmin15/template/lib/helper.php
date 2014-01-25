[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToEdit($object, $params)
  {
    $obj = $object instanceOf sfOutputEscaperObjectDecorator ? $object->getRawValue() : $object;
    if (isset($params['show_when']))
    {
      $show_when = $params['show_when'];
    }

    if (method_exists($obj, 'canEdit') && !$obj->canEdit())
    {
      return '<li class="sf_admin_action_edit_disabled">'.__($params['label'], array(), 'sf_admin').'</li>';
    }

    if (isset($show_when))
    {
      return (call_user_func(array($obj, $show_when))) ? parent::linkToEdit($object, $params) : '';
    }
    else
    {
      return parent::linkToEdit($object, $params);
    }
  }

  public function linkToDelete($object, $params)
  {
    $obj = $object instanceOf sfOutputEscaperObjectDecorator ? $object->getRawValue() : $object;
    if (isset($params['show_when']))
    {
      $show_when = $params['show_when'];
    }

    if (method_exists($obj, 'canDelete') && !$obj->canDelete())
    {
      return '<li class="sf_admin_action_delete_disabled">'.__($params['label'], array(), 'sf_admin').'</li>';
    }

    if (isset($show_when))
    {
      return (call_user_func(array($obj, $show_when))) ? parent::linkToDelete($object, $params) : '';
    }
    else
    {
      return parent::linkToDelete($object, $params);
    }
  }

  public function linkToShow($object, $params)
  {
    $obj = $object instanceOf sfOutputEscaperObjectDecorator ? $object->getRawValue() : $object;
    if (isset($params['show_when']))
    {
      $show_when = $params['show_when'];
    }

    if (method_exists($obj, 'canShow') && !$obj->canShow())
    {
      return '<li class="sf_admin_action_show_disabled">'.__($params['label'], array(), 'sf_admin').'</li>';
    }

    if (isset($show_when))
    {
      return (call_user_func(array($obj, $show_when))) ? '<li class="sf_admin_action_show">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('show'), $object).'</li>' : '';
    }
    else
    {
      return '<li class="sf_admin_action_show">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('show'), $object).'</li>';
    }
  }

  public function linkToExport($params)
  {
    $params['action'] = isset($params['action'])? $params['action'] : 'doExportationPages';
    $params['label'] = 'Export';

    return '<li class="sf_admin_action_export">'.link_to_function(__('Export'),
"
jQuery('#sf_admin_exportation').show();
jQuery('#sf_admin_exportation_ajax_indicator').show();
jQuery('#sf_admin_exportation_form').hide();
jQuery('#sf_admin_exportation').centerHorizontally();

jQuery('#sf_admin_exportation_form').load('".url_for(sfContext::getInstance()->getModuleName().'/'.$params['action'])."',

  function (response, status, xhr) {
    if (status != 'error')
    {
      jQuery('#sf_admin_exportation').show();
      jQuery('#sf_admin_exportation_ajax_indicator').hide();
      jQuery('#sf_admin_exportation_form').show();
      jQuery('#sf_admin_exportation').centerHorizontally();
      jQuery('#sf_admin_exportation_resizable_area').ensureVisibleHeight();
      jQuery(document).scrollTop(jQuery('#sf_admin_exportation').offset().top);
    }
  }
)").'</li>';
  }

  public function linkToUserExport($params)
  {
    $params['action'] = isset($params['action'])? $params['action'] : 'newUserExportation';
    $params['label'] = 'Custom export';

    return '<li class="sf_admin_action_user_export">'.link_to_function(__('Custom export'),
"
jQuery('#sf_admin_exportation').show();
jQuery('#sf_admin_exportation_ajax_indicator').show();
jQuery('#sf_admin_exportation_form').hide();
jQuery('#sf_admin_exportation').centerHorizontally();

jQuery('#sf_admin_exportation_form').load('".url_for(sfContext::getInstance()->getModuleName().'/'.$params['action'])."',

  function (response, status, xhr) {
    if (status != 'error')
    {
      jQuery('#sf_admin_exportation').show();
      jQuery('#sf_admin_exportation_ajax_indicator').hide();
      jQuery('#sf_admin_exportation_form').show();
      jQuery('#sf_admin_exportation').centerHorizontally();
      jQuery('#sf_admin_exportation_resizable_area').ensureVisibleHeight();
      jQuery(document).scrollTop(jQuery('#sf_admin_exportation').offset().top);
    }
  }
)").'</li>';
  }

}
