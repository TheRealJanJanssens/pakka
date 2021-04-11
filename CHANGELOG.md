# Changelog

All notable changes to `pakka` will be documented in this file.

## 0.2.3 - 2021-04-11
- Composer package cart patch

## 0.2.2 - 2021-04-11
- Fixed linkedin logo (pulled the instagram logo)
- Fixed Attribute assets in the sections that uses the maps api
- Connected maps.php config file

## 0.2.1 - 2021-04-11
- Progress in renaming section names 
- Image controller fix to prevent duplicate folders
- Added Column alignment option in lay-out editor
- Added getPackageInfo() helper
- Saving pakka version in session variable to show in admin panel
- Success messages in admin panel connected
- Added protected setting category "scripts"
- Added custom css and js settings
- Connected custom css and js to content load

## 0.2.0 - 2021-04-10
- Removed Unikent/tcache class from app.config
- Connected broken model links in CARTDT01001
- Connected broken model links in CHKTST01001
- Added 'Inter' Google font
- Model connection fix in shipmentOptions model
- Replaced str_random() with generateString() in helper function move_file()
- Replaced if statement with try catch block to catch the mollie exception when in admin order detail
- Order detail fix to the HTML showing in the delivery section
- Fixed the Blazy revalidate on in the section builder
- added slider options to CVR1
- Color fixes
- Added extra layout assets to price blocks
- Progress in renaming section names 

## 0.1.7 - 2021-04-07
- Template select on Page create failsafe added
- Fixed unknown $result in Template::getSelect()
- Route generation now uses the correct object syntax
- Connected Placeholder sections properly
- Fixed package paths in helper functions getCompMeta() and getSectionView()
- Added failsafes (NULL) to classes, attributes, extras when adding new sections
- Added new dividers curve, curve_invert, paper_rip
- Added Patrick Hand font
- Added customizable highlight-, dark- and gray colours
- Added highlight class in custom css to have a modern marker effect
- Connected the new highlight-, dark- and grey colours to theme.css and builder tools
- Added slider and slider options to CVRTXT4
- Fixed the status select on page forms
- Added a status parameter on Page::getPages() method
- Added side dividers (only available in selected sections)
- New section FEATLG09001
- New section FEATLG09002
- Connected CheckForMaintenanceMode.php in install process
- Added Forms module for creating custom forms.

## 0.1.6 - 2021-03-30
- Set timestaps on false in Language Model
- Fix of duplicate naming "login" in routes
- Changed the route 'as' variable to 'template' to enable unique names for the routes

## 0.1.5 - 2021-03-29
- Added CheckForMaintenanceMode.php

## 0.1.4 - 2021-03-29
- Migration section_items insert patch
- Terminal "Language table not found" fix on fresh install

## 0.1.3 - 2021-03-28
- Migration patch

## 0.1.2 - 2021-03-28
- Migration patch

## 0.1.1 - 2021-03-28
- Reconnect asset images who where missing (mapmarkers, etc.)
- Section preview loading background to prevent invisible sections in list
- Added all current tables as migrations
- Added inserts for the languages and section_items tables
- Added failsafe to first check if the language table exists in the getPages() method to prevent an error is being thrown
- Added migrations
- Updated pakka-install command to cover migrations

## 0.1.0 - 2021-03-23
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

## 0.0.5 - 2021-03-20
- Added a 0 format to the images to save uploaded images in their original size
- Support webp image upload
- updated ytplayer.min.js
- Fixed failed login error message
- Remove dd in parse content helper
- Fix translate labels in constructInputs
- added image compression option
- added webp convert option (not tested due wrong enviroment)
- Fixed position issues when adding a new section

## 0.0.4 - 2021-03-18
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
- Fixed locale and fallback locale reverting back to 'en' due to limited config (app.php)
- Checkout form block added validation to address fields

## 0.0.3 - 2021-03-15

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

## 0.0.2 - 2021-02-27

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

## 0.0.1 - 2021-02-10

- Initial release
