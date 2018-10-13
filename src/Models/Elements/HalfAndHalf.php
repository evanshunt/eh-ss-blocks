<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image_Backend;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\ORM\FieldType\DBHTMLText;
use EvansHunt\LinkItemField\Forms\LinkItemField;
use EvansHunt\LinkItemField\Model\LinkItem;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Security\Permission;

class HalfAndHalfElement extends BaseElement
{

    public function canView($member = null)
    {
        return true;
    }

    private static $db = [
        'LeftTitle' => 'Varchar',
        'LeftCopy' => 'HTMLText',
        'RightTitle' => 'Varchar',
        'RightCopy' => 'HTMLText',
    ];

    private static $has_one = [
        'LeftBackground' => Image::class,
        'LeftCTA' => LinkItem::class,
        'RightBackground' => Image::class,
        'RightCTA' => LinkItem::class
    ];

    private static $owns = [
        'LeftBackground',
        'RightBackground',
        'LeftCTA',
        'RightCTA'
    ];

    private static $cascade_deletes = [
        'LeftBackground',
        'RightBackground',
        'LeftCTA',
        'RightCTA'
    ];

    private static $cascade_duplicates = [
        'LeftBackground',
        'RightBackground',
        'LeftCTA',
        'RightCTA'
    ];

    private static $extensions = [
        Versioned::class;
    ];

    private static $singular_name = 'Half and Half';

    private static $plural_name = 'Half and Halfs';

    private static $description = 'Image blocks with content and button side by side';

    private static $table_name = 'HalfAndHalfElement';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
        $fields->removeByName('Settings');
        $fields->fieldByName('Root.Main')->setTitle('Left Block');

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('LeftTitle', 'Left Title'),
            HtmlEditorField::create('LeftCopy', 'Left Copy'),
            LinkItemField::create('LeftCTAID', 'Call To Action'),
            $imageUpload = UploadField::create('LeftBackground', 'Left Background')->setDescription('Background image that is displayed behind the content')
        ]);

        $fields->addFieldsToTab('Root.Right Block', [
            TextField::create('RightTitle', 'Right Title'),
            HtmlEditorField::create('RightCopy', 'Right Copy'),
            LinkItemField::create('RightCTAID', 'Call To Action'),
            $imageUpload2 = UploadField::create('RightBackground', 'Right Background')->setDescription('Background image that is displayed behind the content')
        ]);

        $imageUpload->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg'
        ));
        $imageUpload2->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg'
        ));
        $imageUpload->setFolderName('background');
        $imageUpload2->setFolderName('background');

        return $fields;
    }

    public function getType()
    {
        return 'Half and Half';
    }
}
