<?php

namespace EvansHunt\Elements;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Security\Permission;

class ImageCarouselItem extends DataObject {

  public function canView($member = null)
  {
    return true;
  }

  private static $has_one = [
    'SlideImage' => Image::class,
    'Parent' => ImageCarouselElement::class
  ];

  private static $db = [
    'Title' => 'Varchar(255)',
    'Content' => 'HTMLText',
    'Sort' => 'Int'
  ];

  private static $owns = [
    'SlideImage'
  ];

  private static $cascade_deletes = [
    'SlideImage'
  ];

  private static $cascade_duplicates = [
    'SlideImage'
  ];

  private static $extensions = [
    Versioned::class
  ];

  private static $summary_fields = [
    'Title' => 'Title'
  ];

  private static $singular_name = 'Image Carousel Item';

  private static $plural_name = 'Image Carousel Items';

  private static $description = 'Image Carousel Item Data Object';

  private static $table_name = 'ImageCarouselItem';

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

}
