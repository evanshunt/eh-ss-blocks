<?php

namespace Elements {
    use DNADesign\Elemental\Models\BaseElement;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\File;

    class SideBySideElement extends BaseElement
    {
        private static $table_name = 'SideBySideElement';
        private static $singular_name = 'Side by side CTA Block';
        private static $plural_name = 'Side by side CTA Blocks';
        private static $description = 'Side by side CTA blocks with image behind content and a button.';

        private static $db = [
            'LeftTitle' => 'Varchar(255)',
            'LeftSubtitle' => 'Varchar(255)',
            'LeftCopy' => 'HTMLText',
            'LeftLink' => 'Varchar(255)', // TODO: Change this with proper link module.
            'RightTitle' => 'Varchar(255)',
            'RightSubtitle' => 'Varchar(255)',
            'RightCopy' => 'HTMLText',
            'RightLink' => 'Varchar(255)', // TODO: Change this with proper link module.
        ];

        private static $has_one = [
            'LeftBackground' => Image::class,
            'RightBackground' => Image::class
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
            $fields->removeByName('Settings');

            $fields->addFieldsToTab('Root.Left Block', [
                TextField::create('LeftTitle', 'Title'),
                TextField::create('LeftSubtitle', 'Subtitle'),
                HtmlEditorField::create('LeftCopy', 'Copy'),
                $leftImageUpload = UploadField::create('LeftBackground', 'Background')->setDescription('Background image that is displayed behind the content'),
                TextField::create('LeftLink', 'URL')
            ]);

            $fields->addFieldsToTab('Root.Right Block', [
                TextField::create('RightTitle', 'Title'),
                TextField::create('RightSubtitle', 'Subtitle'),
                HtmlEditorField::create('RightCopy', 'Copy'),
                $rightImageUpload = UploadField::create('RightBackground', 'Background')->setDescription('Background image that is displayed behind the content'),
                TextField::create('RightLink', 'URL')
            ]);

            foreach ([$leftImageUpload, $rightImageUpload] as $imageUpload) {
                $imageUpload->setFolderName('background')->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
            };

            return $fields;
        }

        private static $owns = [
            'LeftBackground',
            'RightBackground'
        ];

        public function getType()
        {
            return 'Side by side CTA blocks';
        }
    }
}
