<?php

class RequiredMetadataPlugin     extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array(
		'before_save_item'
	);
	
    protected $_filters = array(
        //'requiredItemValidator' => array('Validate', 'Item', 'CAVPP_PB    Core', 'Institution'),
        //'itemTitleLengthValidator' => array('Validate', 'Item', 'CAVPP    _PBCore', 'Title'),
        //'requiredItemValidator' => array('Validate', 'Item', 'CAVPP_PB    Core', 'Date Created'),
        //'itemTitleLengthValidator' => array('Validate', 'Item', 'Dublin     Core', 'Title'),
        //'itemTitleLengthValidator' => array('Validate', 'Item', 'Dublin     Core', 'Subject'),
        //'requiredItemValidator' => array('Validate', 'Item', 'Dublin C    ore', 'Title'),
        //'addIsbnToDCId'=>array('Save', 'Item', 'Dublin Core', 'Identifie    r'),
    );

	public function hookBeforeSaveItem($args)
    {
        $item = $args['record'];
        $title = metadata($item, array('Dublin Core', 'Title'));
        if(empty($title)) {
            $item->addError("DC Title", 'DC Title cannot be empty!');
        }
    }
	
    public function itemTitleLengthValidator($isValid, $args)
    {
        $text = $args['text'];
        if(strlen($text) < 10 ) {
            return false;
        }
        return true;
    }

    public function requiredItemValidator($isValid, $args)
    {
        $text = $args['text'];
        if(!isset($text) || $text == null || $text == false) {
            return false;
        }
        return true;
    }

    /******
	public function addIsbnToDCId($text, $args)
    {
        return "ISBN: $text";
    }
	*******/
}
