## Setup

Steps to install this on your SilverStripe:

- Open `src/composer.json`.
- Add the `https://github.com/evanshunt/eh-ss-blocks` URL to a `repositories` parameter.
    ```
      "repositories": [{
        "type": "vcs",
        "url": "https://github.com/evanshunt/eh-ss-blocks"
      }]
    ```
- Add `"evanshunt/elemental-addons": "dev-master"` to your `require` list.
- Run `composer update --ignore-platform-reqs`.