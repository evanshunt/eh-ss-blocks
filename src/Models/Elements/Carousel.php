<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class Carousel extends BaseElement
{
  private static $icon = 'font-icon-picture';

  private static $singular_name = 'Carousel';

  private static $plural_name = 'Carousels';

  private static $description = 'Carousel block with multiple Carousel Items';

  private static $db = [
    'Body' => 'HTMLText'
  ];

	private static $has_many = [
    'CarouselItems' => CarouselItem::class
  ];

  private static $cascade_deletes = [
    'CarouselItems'
  ];

	public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');
    $fields->removeByName('CarouselItems');

    $fields->addFieldsToTab('Root.Main', Fieldlist::create(
      HTMLEditorField::create('Body')->setRows(10),
      GridField::create(
        'CarouselItems',
        'Carousel items',
        $this->CarouselItems(),
        $gridConfig = GridFieldConfig_RecordEditor::create()
      )
    ));
    $gridConfig->addComponent(new GridFieldOrderableRows());

    return $fields;
  }

  public function getType()
  {
    return 'Carousel';
  }

}