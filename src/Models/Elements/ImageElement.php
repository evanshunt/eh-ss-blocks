<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Security\Permission;

class ImageElement extends BaseElement
{

    public function canView($member = null)
    {
        return true;
    }

    private static $db = [

    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $cascade_deletes = [
        'Image'
    ];

    private static $cascade_duplicates = [
        'Image'
    ];

    private static $extensions = [
        Versioned::class
    ];

    private static $singular_name = 'Image';

    private static $plural_name = 'Images';

    private static $description = 'Full width image that provides a visual break in the page.';

    private static $table_name = 'ImageElement';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeFieldFromTab('Root.Main', 'Title');
        $fields->removeFieldFromTab('Root.Main', 'TitleAndDisplayed');
        $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
        $fields->removeByName('Settings');

        $fields->addFieldsToTab('Root.Main', [
            $imageUpload = UploadField::create('Image', 'Image')->setDescription('')
        ]);

        $imageUpload->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg'
        ));
        $imageUpload->setFolderName('image-element');

        return $fields;
    }

    public function getType()
    {
        return 'Image';
    }
}
