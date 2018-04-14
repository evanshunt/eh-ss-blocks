<?php

namespace EvansHunt\Elements;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class CarouselItem extends DataObject {

  private static $has_one = [
    'ImageLeft' => Image::class,
    'ImageRight' => Image::class,
    'Parent' => CarouselElement::class
  ];

  private static $db = [
    'Title' => 'Varchar(255)',
    'ContentLeft' => 'HTMLText',
    'ContentRight' => 'HTMLText',
    'Sort' => 'Int'
  ];

  private static $summary_fields = [
    'Title' => 'Title'
  ];

  private static $singular_name = 'Carousel Item';

  private static $plural_name = 'Carousel Items';

  private static $description = 'Carousel Item Data Object';

  private static $table_name = 'CarouselItem';

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->addFieldsToTab('Root.Main',
      [
        HTMLEditorField::create('ContentLeft', 'Content Left')->setRows(5),
        HTMLEditorField::create('ContentRight', 'Content Right')->setRows(5),
        $leftImageUpload = UploadField::create('ImageLeft', 'Left Image')->setDescription('Image that is displayed on the left (for desktop)'),
        $rightImageUpload = UploadField::create('ImageRight', 'Right Image')->setDescription('Image that is displayed on the right (for desktop)')
      ]
    );

    $leftImageUpload->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
    $leftImageUpload->setAllowedFileCategories('image');
    $leftImageUpload->setFolderName('carousel');

    $rightImageUpload->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
    $rightImageUpload->setAllowedFileCategories('image');
    $rightImageUpload->setFolderName('carousel');

    $fields->removeByName('Sort');

    return $fields;
  }
}
