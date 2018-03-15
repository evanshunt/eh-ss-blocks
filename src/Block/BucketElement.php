<?php

namespace EvansHunt\ElementalAddons;

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
use CyberDuck\LinkItemField\Forms\LinkItemField;
use CyberDuck\LinkItemField\Model\LinkItem;

class BucketElement extends BaseElement
{
    private static $db = [
        'Copy' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'CTA' => LinkItem::class
    ];

    private static $owns = [
        'Image'
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
            LinkItemField::create('CTAID', 'Call To Action')
        ]);

        $imageUpload->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg', 'svg'
        ));
        $imageUpload->setFolderName('bucket');

        return $fields;
    }

    public function getType()
    {
        return 'Bucket';
    }

     /**
     * For the frontend, return a parsed set of data for use in templates
     *
     * @return ArrayData|null
     */
    public function CallToActionLink()
    {
        return $this->decodeLinkData($this->getField('CallToActionLink'));
    }

    /**
     * Given a set of JSON data, decode it, attach the relevant Page object and return as ArrayData
     *
     * @param string $linkJson
     * @return ArrayData|null
     */
    protected function decodeLinkData($linkJson)
    {
        if (!$linkJson || $linkJson === 'null') {
            return;
        }

        $data = ArrayData::create(Convert::json2obj($linkJson));

        // Link page, if selected
        if ($data->PageID) {
            $data->setField('Page', self::get_by_id(SiteTree::class, $data->PageID));
        }

        return $data;
    }
}
