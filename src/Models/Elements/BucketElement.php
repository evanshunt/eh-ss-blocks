<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use CyberDuck\LinkItemField\Forms\LinkItemField;
use CyberDuck\LinkItemField\Model\LinkItem;
use SilverStripe\Versioned\Versioned;

class BucketElement extends BaseElement
{
    public function canView($member = null)
    {
        return true;
    }

    private static $db = [
        'Copy' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'CTALink' => LinkItem::class
    ];

    private static $owns = [
        'Image',
        'CTALink'
    ];

    private static $cascade_deletes = [
        'Image',
        'CTALink'
    ];

    private static $cascade_duplicates = [
        'Image',
        'CTALink'
    ];

    private static $extensions = [
        Versioned::class
    ];

    private static $singular_name = 'Bucket';

    private static $plural_name = 'Buckets';

    private static $description = 'Content bucket to be used in a List';

    private static $table_name = 'BucketElement';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
        $fields->removeByName('Settings');

        $fields->addFieldsToTab('Root.Main', [
            $imageUpload = UploadField::create('Image', 'Image')->setDescription('Optional image that appears at the top of the bucket'),
            HtmlEditorField::create('Copy', 'Copy'),
            LinkItemField::create('CTALinkID', 'Call To Action')
        ]);

        $imageUpload->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg', 'svg'
        ));
        $imageUpload->setFolderName('bucket');

        return $fields;
    }

    public function getType() : string
    {
        return 'Bucket';
    }
}
