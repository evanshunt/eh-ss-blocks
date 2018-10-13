<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\OptionsetField;
use EvansHunt\LinkItemField\Model\LinkItem;
use EvansHunt\LinkItemField\Forms\LinkItemField;
use Bummzack\SortableFile\Forms\SortableUploadField;
use SilverStripe\Versioned\Versioned;

class DocumentsListElement extends BaseElement
{
  private static $icon = 'font-icon-block-file-list';

  private static $singular_name = 'Documents List';

  private static $plural_name = 'Documents Lists';

  private static $description = 'Documents list block with multiple Documents (title + file)';

  private static $table_name = 'DocumentsListElement';

  private static $db = [
    'Content' => 'HTMLText',
    'DisplayType' => "Enum('List, Icons')"
  ];

  private static $has_one = [
    'ReadMoreLink' => LinkItem::class
  ];

  private static $many_many = [
    'DocumentFiles' => File::Class
  ];

  private static $many_many_extraFields = [
    'DocumentFiles' => ['SortOrder' => 'Int']
  ];

  private static $cascade_deletes = [
      'ReadMoreLink',
      'DocumentFiles'
  ];

  private static $cascade_duplicates = [
      'ReadMoreLink',
      'DocumentFiles'
  ];

  private static $owns = [
    'ReadMoreLink',
    'DocumentFiles'
  ];

  private static $extensions = [
    Versioned::class . '.versioned'
  ];

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');
    $fields->removeByName('DocumentFiles');

    $fields->addFieldsToTab('Root.Main',
      [
        $documentUpload = SortableUploadField::create('DocumentFiles', 'Documents')->setDescription('Upload one or more documents'),
        HTMLEditorField::create('Content', 'Content')->setRows(10)
      ]
    );
    $fields->addFieldToTab('Root.Main', OptionsetField::create('DisplayType', 'Display Type', ['List' => 'List - simple list of titles and links to documents', 'Icons' => 'Icons - medium size icons with links to documents'], 'List'));
    $fields->addFieldToTab('Root.Main', LinkItemField::create('ReadMoreLinkID', 'Read More Link'));

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
