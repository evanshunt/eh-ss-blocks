<?php

namespace EvansHunt\Elements {

    use DNADesign\Elemental\Models\BaseElement;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\File;
    use CyberDuck\LinkItemField\Forms\LinkItemField;
    use CyberDuck\LinkItemField\Model\LinkItem;
    use SilverStripe\Versioned\Versioned;
    use SilverStripe\Security\Permission;

    class SideBySideElement extends BaseElement
    {
        private static $table_name = 'SideBySideElement';
        private static $singular_name = 'Side by side CTA Block';
        private static $plural_name = 'Side by side CTA Blocks';
        private static $description = 'Side by side CTA blocks with image behind content and a button.';

        private static $inline_editable = false; // inline editing doesn't work with tabs


        private static $db = [
            'LeftTitle' => 'Varchar(255)',
            'LeftSubtitle' => 'Varchar(255)',
            'LeftCopy' => 'HTMLText',
            'RightTitle' => 'Varchar(255)',
            'RightSubtitle' => 'Varchar(255)',
            'RightCopy' => 'HTMLText',
        ];

        private static $has_one = [
            'LeftBackground' => Image::class,
            'LeftCTA' => LinkItem::class,
            'RightBackground' => Image::class,
            'RightCTA' => LinkItem::class
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

                $fields->addFieldsToTab('Root.Left Block', [
                    TextField::create('LeftTitle', 'Title'),
                    TextField::create('LeftSubtitle', 'Subtitle'),
                    HtmlEditorField::create('LeftCopy', 'Copy'),
                    $leftImageUpload = UploadField::create('LeftBackground', 'Background')->setDescription('Background image that is displayed behind the content'),
                    LinkItemField::create('LeftCTAID', 'Call To Action'),
                ]);

                $fields->addFieldsToTab('Root.Right Block', [
                    TextField::create('RightTitle', 'Title'),
                    TextField::create('RightSubtitle', 'Subtitle'),
                    HtmlEditorField::create('RightCopy', 'Copy'),
                    $rightImageUpload = UploadField::create('RightBackground', 'Background')->setDescription('Background image that is displayed behind the content'),
                    LinkItemField::create('RightCTAID', 'Call To Action'),
                ]);

                foreach ([$leftImageUpload, $rightImageUpload] as $imageUpload) {
                    $imageUpload->setFolderName('background')->getValidator()->setAllowedExtensions(['png','jpeg','jpg']);
                }
            });

            return parent::getCMSFields();
        }

        private static $owns = [
            'LeftBackground',
            'RightBackground',
            'LeftCTA',
            'RightCTA'
        ];

        public function getType()
        {
            return 'Side by side CTA blocks';
        }
    }
}
