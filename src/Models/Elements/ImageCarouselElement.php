<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Core\Convert;
use SilverStripe\View\Requirements;

class ImageCarouselElement extends BaseElement
{
  private static $icon = 'font-icon-picture';

  private static $singular_name = 'Image Carousel';

  private static $plural_name = 'Image Carousels';

  private static $description = 'Carousel block with multiple Carousel Items';

  private static $table_name = 'ImageCarouselElement';

  private static $db = [
    'Body' => 'HTMLText'
  ];

  private static $has_many = [
    'ImageCarouselItems' => ImageCarouselItem::class
  ];

  private static $cascade_deletes = [
    'ImageCarouselItems'
  ];

  private static $cascade_duplicates = [
    'ImageCarouselItems'
  ];

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');
    $fields->removeByName('ImageCarouselItems');

    $fields->addFieldsToTab('Root.Main', Fieldlist::create(
      HTMLEditorField::create('Body')->setRows(10),
      GridField::create(
        'ImageCarouselItems',
        'Carousel items',
        $this->ImageCarouselItems(),
        $gridConfig = GridFieldConfig_RecordEditor::create()
      )
    ));
    $gridConfig->addComponent(new GridFieldOrderableRows());

    return $fields;
  }

  public function getType()
  {
    return 'Image Carousel';
  }

  // required fields: title
  public function validate()
  {
    $result = parent::validate();
    if (empty($this->Title)) {
      $result->addError('Carousel Title is required field.');
    }
    return $result;
  }

  public function loadCarouselRequirements() {

    Requirements::javaScript('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js');
    Requirements::javaScript('evanshunt/elemental-addons:js/carousel-slick-init.js');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    Requirements::customScript("var GLOBAL_IMGCAROUSEL_OPTIONS = " . $this->slickOptionsJs() . ";");
  }

  // function to get Slick configuration from yml file into slick JS file
  // Exports Slim specific settings from YAML to JavaScript so that they can be easily used when initialising Slick
  // Even if the validation fails, convert and return the options so that the developer can see from the output how the options come out.
  // slick info: http://kenwheeler.github.io/slick/
  public function slickOptionsJs() {
    self::validate_image_carousel_options();
    return Convert::array2json(self::config()->get('image_carousel_options'));
  }

  /**
   * Just checks that the Slick configuration options in YAML is listed in a correct format without preceding dashes
   * in option lines. Otherwise the options would render as nested arrays inside the settings array, which would render
   * the options useless. Perhaps not very much needed check, but as I made this mistake once, I don't want to make
   * it again without getting any notifications! :)
   *
   * WRONG:
   * Carousel:
   *   image_carousel_options:
   *     - autoplay: true
   *     - autoplaySpeed: 3000
   *
   * CORRECT:
   * Carousel:
   *   image_carousel_options:
   *     autoplay: true
   *     autoplaySpeed: 3000
   */
  private static function validate_image_carousel_options()
  {
    $image_carousel_options = self::config()->get('image_carousel_options');
    if (isset($image_carousel_options[0])) {
      user_error('Slick carousel options are defined in an incorrect format in YAML. Option lines should not be preceded with dashes.', E_USER_WARNING);
    }
  }

}
