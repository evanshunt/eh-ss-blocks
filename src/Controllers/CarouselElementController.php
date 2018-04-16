<?php

namespace EvansHunt\Elements;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Controllers\BaseElementController;
use SilverStripe\View\Requirements;

// Carousel Element controller to requires some slick javascript files
class CarouselElementController extends BaseElementController
{

  public static function Requirements() {

    Requirements::javascript('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    Requirements::css('//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    Requirements::customScript("var GLOBAL_SLICK_OPTIONS = " . self::slickOptionsJs() . ";");

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
