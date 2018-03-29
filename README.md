Make sure you have [Elemental](https://github.com/dnadesign/silverstripe-elemental) and [Elemental-List](https://github.com/dnadesign/silverstripe-elemental-list) installed prior to moving on to the next section.

## Setup

Steps to install this on your SilverStripe:

- Open your SilverStripe's `src/composer.json`.
- Add the `https://github.com/evanshunt/eh-ss-blocks` URL to a `repositories` parameter.
    ```
      "repositories": [{
        "type": "vcs",
        "url": "https://github.com/evanshunt/eh-ss-blocks"
      }]
    ```
- Add `"evanshunt/elemental-addons": "dev-master"` to your `require` list.
- Run `composer update --ignore-platform-reqs`.

## Creating Templates

Within the project's `templates` folder create a `EvansHunt/Elements` folder. Inside this folder will be all the `.ss` files related to each element.

[ContentElement](/docs/templating/content-element.md)

[HalfAndHalfElement](/docs/templating/half-and-half-element.md)

[ImageElement](/docs/templating/image-element.md)

[BucketElement](/docs/templating/bucket-element.md)

### To Dos

1. Introduce a new CTA module for elements to use.
2. ~~Add documentation for each content block. Including template naming conventions.~~
3. Create more blocks
    - Gallery
    - CTA Banners (left/right content options)
    - File lists
    - Two column text