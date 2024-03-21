<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\RequiredFields;
use Bummzack\SortableFile\Forms\SortableUploadField;
use CyberDuck\LinkItemField\Model\LinkItem;
use SilverStripe\Versioned\Versioned;

class DocumentsListElement extends BaseElement {

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
        'DocumentFiles' => File::class
    ];

    private static $many_many_extraFields = [
        'DocumentFiles' => ['SortOrder' => 'Int']
    ];

    private static $extensions = [
        Versioned::class
    ];

    public function getCMSFields()
    {
        // Using beforeUpdateCMSFields allows extensions to modify these fields,
        // because the extension is guaranteed to hook in AFTER this action.
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
            $fields->removeByName('Settings');
            $fields->removeByName('DocumentFiles');

            $fields->addFieldsToTab('Root.Main', [
                $documentUpload = SortableUploadField::create('DocumentFiles', 'Documents')
                ->setDescription('Upload one or more documents'),
                HTMLEditorField::create('Content', 'Content')->setRows(10),
                OptionsetField::create(
                    'DisplayType',
                    'Display Type',
                    [
                        'List' => 'List - simple list of titles and links to documents',
                        'Icons' => 'Icons - medium size icons with links to documents',
                    ],
                    'List'
                )
            ]);

            $documentUpload->getValidator()->setAllowedExtensions(['pdf', 'doc', 'xls', 'ppt']);
            $documentUpload->setAllowedFileCategories('document');
            $documentUpload->setFolderName('documents');
        });

        return parent::getCMSFields();
    }

    private static $owns = [
        'ReadMoreLink',
        'DocumentFiles'
    ];

    public function getType() {
        return 'Documents List';
    }

    // required fields: title
    public function getCMSValidator() {
        return new RequiredFields(['Title']);
    }
}
