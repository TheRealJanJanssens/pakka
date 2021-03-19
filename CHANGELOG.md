# Changelog

All notable changes to `pakka` will be documented in this file.

## 0.0.6 - 2020-03-xx
## 0.0.5 - 2020-03-20
- Added a 0 format to the images to save uploaded images in their original size
- Support webp image upload
- updated ytplayer.min.js
- Fixed failed login error message
- Remove dd in parse content helper
- Fix translate labels in constructInputs
- added image compression option
- added webp convert optiion (not tested due wrong enviroment)
- Fixed position issues when adding a new section

## 0.0.4 - 2020-03-18
- Connected old 'variable.' configs to 'pakka.'
- Connect Helpers directory
- Connect Providers
- Added HelperServiceProvider
- Added app.php config in package
- Added Install & Clean Command
- Added make:user Command
- README.md update
- Invoice template added hardcoded widths in table
- Invoice overview added fixed widths to total and actions
- Fixed locale and fallback locale reverting back to en due to limited config (app.php)
- Checkout form block added validation to address fields

## 0.0.3 - 2020-03-15

- Helper constructAttributes fix (setAttribute and null failsafes)
- Added a functionality to support custom sections
- General Section fixes to address namespace errors
- Linked font config
- Linked section css and js
- Product model convert to objects
- Connect image config file
- Resolved "ADMIN . " issues
- Resolved Form actions
- Resolved route() issues in controllers
- Kernel fix (Session and Auth problems)

## 0.0.2 - 2020-02-27

- Dev require Psalm
- Route connect
- Source Sass & JS webpack connect for development
- Namespaces update
- Connect php artisan publish command
- Connect helpers
- Connect macros
- Connect models
- Connect controllers
- Connect base config files
- Connect Auth overide controllers and routes

## 0.0.1 - 2020-02-10

- Initial release
