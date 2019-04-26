<?php

namespace EvansHunt\Elements {

    use DNADesign\Elemental\Models\BaseElement;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;

    class ImageElement extends BaseElement {

        private static $db = [];

        private static $has_one = [
            'Image' => Image::class
        ];

        private static $table_name = 'ImageElement';

        private static $singular_name = 'Image';

        private static $plural_name = 'Images';

        private static $description = 'Basic image block.';

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            $fields->removeFieldFromTab('Root.Main', 'TitleAndDisplayed');
            $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
            $fields->removeByName('Settings');

            $fields->addFieldsToTab('Root.Main', [
                $imageUpload = UploadField::create('Image', 'Image')
            ]);

            $imageUpload->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
            $imageUpload->setFolderName('image-element');

            return $fields;
        }

        private static $owns = [
            'Image'
        ];

        public function getType()
        {
            return 'Image';
        }
    }
}
