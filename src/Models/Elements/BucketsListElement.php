<?php

namespace EvansHunt\Elements;

use DNADesign\ElementalList\Model\ElementList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class BucketsListElement extends ElementList
{
  private static $db = [
    'Content' => 'HTMLText',
    'BackgroundClass' => 'Varchar'
  ];

  private static $table_name = 'BucketsList';

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

    $fields->addFieldsToTab('Root.Main',
      [
        HTMLEditorField::create('Content', 'Content')->setRows(10)
      ]
    );

    // look at yml config to see if we want to have options for background class/colour when editing the list
    // EvansHunt\Elements\BucketsListElement and background with multiple options
    $bgOptions = self::config()->get('background');
    if ($bgOptions && is_array($bgOptions)) {
      $default = $bgOptions[0];
      $bgOptions = array_combine($bgOptions, $bgOptions);

      $fields->addFieldToTab('Root.Main', OptionsetField::create('BackgroundClass', 'Background Colour/Class', $bgOptions, $default));
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
}
