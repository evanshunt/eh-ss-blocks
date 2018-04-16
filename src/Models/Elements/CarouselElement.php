<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Core\Convert;

class CarouselElement extends BaseElement
{
  private static $icon = 'font-icon-picture';

  private static $singular_name = 'Carousel';

  private static $plural_name = 'Carousels';

  private static $description = 'Carousel block with multiple Carousel Items';

  private static $table_name = 'CarouselElement';

  private static $db = [
    'Body' => 'HTMLText'
  ];

  private static $has_many = [
    'CarouselItems' => CarouselItem::class
  ];

  private static $cascade_deletes = [
    'CarouselItems'
  ];

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeFieldFromTab('Root.Settings', 'ExtraClass');
    $fields->removeByName('Settings');
    $fields->removeByName('CarouselItems');

    $fields->addFieldsToTab('Root.Main', Fieldlist::create(
      HTMLEditorField::create('Body')->setRows(10),
      GridField::create(
        'CarouselItems',
        'Carousel items',
        $this->CarouselItems(),
        $gridConfig = GridFieldConfig_RecordEditor::create()
      )
    ));
    $gridConfig->addComponent(new GridFieldOrderableRows());

    return $fields;
  }

  public function getType()
  {
    return 'Carousel';
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

    Requirements::javascript('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    Requirements::customScript("var GLOBAL_SLICK_OPTIONS = " . $this->slickOptionsJs() . ";");

  }

  // function to get Slick configuration from yml file into slick JS file
  // Exports Slim specific settings from YAML to JavaScript so that they can be easily used when initialising Slick
  // Even if the validation fails, convert and return the options so that the developer can see from the output how the options come out.
  // slick info: http://kenwheeler.github.io/slick/
  public function slickOptionsJs() {
    self::validate_slick_options();
    return Convert::array2json(self::config()->get('slick_options'));
  }

  /**
   * Just checks that the Slick configuration options in YAML is listed in a correct format without preceding dashes
   * in option lines. Otherwise the options would render as nested arrays inside the settings array, which would render
   * the options useless. Perhaps not very much needed check, but as I made this mistake once, I don't want to make
   * it again without getting any notifications! :)
   *
   * WRONG:
   * Carousel:
   *   slick_options:
   *     - autoplay: true
   *     - autoplaySpeed: 3000
   *
   * CORRECT:
   * Carousel:
   *   slick_options:
   *     autoplay: true
   *     autoplaySpeed: 3000
   */
  private static function validate_slick_options()
  {
    $slick_options = self::config()->get('slick_options');
    if (isset($slick_options[0])) {
      user_error('Slick carousel options are defined in an incorrect format in YAML. Option lines should not be preceded with dashes.', E_USER_WARNING);
    }
  }

}