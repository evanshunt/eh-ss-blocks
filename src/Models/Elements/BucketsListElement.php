<?php

namespace EvansHunt\Elements;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use DNADesign\ElementalList\Model\ElementList;

class BucketsListElement extends ElementList
{
  private static $db = [
    'Content' => 'HTMLText',
    'BackgroundClass' => 'Varchar'
  ];

  private static $table_name = 'BucketsListElement';

  private static $description = 'Orderable list of bucket elements';

  private static $singular_name = 'Buckets list';

  private static $plural_name = 'Buckets lists';

  public function getType()
  {
    return 'Buckets List';
  }

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');

    $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content', 'Content')->setRows(10), 'Content');

    // look at yml config to see if we want to have options for background class/colour when editing the list
    // EvansHunt\Elements\BucketsListElement and background with multiple options
    $bgOptions = self::config()->get('background');
    if ($bgOptions && is_array($bgOptions)) {
      $default = $bgOptions[0];
      $bgOptions = array_combine($bgOptions, $bgOptions);

      $fields->addFieldToTab('Root.Main', OptionsetField::create('BackgroundClass', 'Background Colour/Class', $bgOptions, $default), 'Content');
    } else {
      $fields->removeByName('BackgroundClass');
    } // end if

    return $fields;
  }

  // required fields: title
  public function validate()
  {
    $result = parent::validate();
    if (empty($this->Title)) {
      $result->addError('Title is required field.');
    }
    return $result;
  }

  public function BackgroundClass() {
    $className = strtolower($this->BackgroundClass);
    $className = str_replace(' ', '-', $className);
    $className = Convert::raw2htmlid($className);
    return $className;
  }
}
