# Changelog

All notable changes to `pakka` will be documented in this file.

## 0.1.5 - 2020-03-29
- Added added CheckForMaintenanceMode.php

## 0.1.4 - 2020-03-29
- Migration section_items insert patch
- Terminal "Language table not found" fix on fresh install

## 0.1.3 - 2020-03-28
- Migration patch

## 0.1.2 - 2020-03-28
- Migration patch

## 0.1.1 - 2020-03-28
- Reconnect asset images who where missing (mapmarkers, etc.)
- Section preview loading background to prevent invisible sections in list
- Added all current tables as migrations
- Added inserts for the languages and section_items tables
- Added failsafe to first check if the language table exists in the getPages() method to prevent an error is being thrown
- Added migrations
- Updated pakka-install command to cover migrations

## 0.1.0 - 2020-03-23
- Invoice form models reconnect
- Select options defined in config translation connect
- Removed invoice_no from required fields in invoice model due to errors when creating a proforma
- added Template module to manage templates
- Added a generateTemplate function to the page model to get a json file with the pagestructure and textual content
- invoice detail change client_country to allow null
- Added a generate template button for each page in the content module
- Altered the constructPageStructure() helper to allow templates
- Connected placholders config
- Fixed the placeholder images paths
- Fixed the "non-existing placeholder image in dropzone" bug
- Connected section dividers
- Added ability to remove dividers

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
