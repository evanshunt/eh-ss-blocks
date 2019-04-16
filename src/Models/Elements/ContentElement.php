<?php

namespace Elements {

    use DNADesign\Elemental\Models\BaseElement;
    use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
    use SilverStripe\Versioned\Versioned;

    class ContentElement extends BaseElement {

        private static $db = [
            'Copy' => 'HTMLText'
        ];

        private static $extensions = [
            Versioned::class
        ];

        private static $singular_name = 'Content';

        private static $plural_name = 'Contents';

        private static $description = 'Flexible content block.';

        private static $table_name = 'ContentElement';

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
            $fields->removeByName('Settings');

            $fields->addFieldsToTab('Root.Main', [
                HtmlEditorField::create('Copy', 'Copy')
            ]);

            return $fields;
        }

        public function getType() {
            return 'Content';
        }
    }
}
