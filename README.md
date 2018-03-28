## Setup

Make sure you have [Elemental](https://github.com/dnadesign/silverstripe-elemental) and [Elemental-List](https://github.com/dnadesign/silverstripe-elemental-list) installed prior to moving on to the next section.

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

### To Do's

1. Introduce a new CTA module for elements to use.
