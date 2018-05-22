<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;

class DocumentsListElement extends BaseElement
{
  private static $icon = 'font-icon-block-file-list';

  private static $singular_name = 'Documents List';

  private static $plural_name = 'Documents Lists';

  private static $description = 'Documents list block with multiple Documents';

  private static $table_name = 'DocumentsListElement';

  private static $db = [
    'Content' => 'HTMLText'
  ];

  private static $many_many = array(
    'DocumentFiles' => File::Class
  );

  private static $cascade_deletes = [
    'DocumentFiles'
  ];

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');

    $fields->addFieldsToTab('Root.Main',
      [
        $documentUpload = UploadField::create('DocumentFiles', 'Documents')->setDescription('Upload one or more document files. Documents will be shown in alphabetical order.'),
        HTMLEditorField::create('Content', 'Content')->setRows(10)
      ]
    );

    $documentUpload->getValidator()->setAllowedExtensions(['pdf', 'doc', 'xls', 'ppt']);
    $documentUpload->setAllowedFileCategories('document');
    $documentUpload->setFolderName('documents');

    return $fields;
  }

  public function getType()
  {
    return 'Documents List';
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
