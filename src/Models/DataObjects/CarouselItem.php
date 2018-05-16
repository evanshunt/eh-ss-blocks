<?php

namespace EvansHunt\Elements;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class CarouselItem extends DataObject {

  private static $has_one = [
    'SlideImage' => Image::class,
    'Parent' => CarouselElement::class
  ];

  private static $db = [
    'Title' => 'Varchar(255)',
    'Content' => 'HTMLText',
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
        HTMLEditorField::create('Content', 'Content')->setRows(5),
        $SlideImageUpload = UploadField::create('SlideImage', 'Image')->setDescription('Image that is displayed in the carousel slide.')
      ]
    );

    $SlideImageUpload->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
    $SlideImageUpload->setAllowedFileCategories('image');
    $SlideImageUpload->setFolderName('carousel');

    $fields->removeByName('Sort');

    return $fields;
  }

  private static $owns = [
    'SlideImage'
  ];
}
