<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Versioned\Versioned;

class ImageElement extends BaseElement {

    private static $db = [];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $table_name = 'ImageElement';

    private static $singular_name = 'Image';

    private static $plural_name = 'Images';

    private static $description = 'Basic image block.';

    private static $extensions = [
        Versioned::class
    ];

    public function getCMSFields()
    {
        // Using beforeUpdateCMSFields allows extensions to modify these fields,
        // because the extension is guaranteed to hook in AFTER this action.
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->removeFieldFromTab('Root.Main', 'TitleAndDisplayed');
            $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
            $fields->removeByName('Settings');

            $fields->addFieldsToTab('Root.Main', [
                $imageUpload = UploadField::create('Image', 'Image')
            ]);

            $imageUpload->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
            $imageUpload->setFolderName('image-element');
        });

        return parent::getCMSFields();
    }

    private static $owns = [
        'Image'
    ];

    public function getType() : string
    {
        return 'Image';
    }
}
