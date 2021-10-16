# Changelog

All notable changes to `pakka` will be documented in this file.

## 0.4.2 - 2021-10-
- Removed some bad code initiating the Form macro
- Unit test debugging
- README changes to document testing
- Removed Psalm
- Added pest instead of phpunit

## 0.4.1 - 2021-10-16
- Removed js alert when reinitiating a slide with meta data
- Directly getting the item id from the url and not from the session while updating items (items, products, content)
- Reconnected cart services module

## 0.4.0 - 2021-10-12
- Connected services, providers and booking modules
- Fixed the the way which the json response is given in getJson() of BookingController
- Added bladeCompile helper to convert a string in a usable blade component wit or without variables
- Added IFRMST01002, IFRMST01003, IFRMST01004
- Added the possibility to link slider meta data (pulled from item modules) like title, text, etc...
- Linked above functionality with HEROIG04001
- Fixed bug that the input labels where not translated in the layout editor
- Fixed a bug where payment amount value was rejected by Mollie
- Small CSS fixes
- Admin panel refinements
- Added Excel exports for all orders, completed orders and invoices
- Fixed settings bug resetting to default value if 0 is the value
- Switch inputs now show the correct stored value

## 0.3.7 - 2021-09-05
- Bugfix: getFormsLinks() throws error when form table is empty
- Created a route fallback for when pages have no postion or position is NULL. This could cause that no index is being set and the "/" url throwing a 404  
- Bugfix: Slider on HEROIG02001 was not visible due to duplicated HTML
- Added IFRMST01001

## 0.3.6 - 2021-06-29
- Fixed array being send through constructAttributes() in Item model. Should have been a object
- Fix to rare issue where set_ids within attribute_inputs cant be distinguish (9 vs 9DxQLZ4j). for more info see AttributeInput line 133
- Refactored the construction of attributes to prevent duplicate empty values overwriting the real values
- GeneralMail subject fix. Wrong translation key
- Added getTemplate() helper to be able te switch templates to app level like sections
- Added getLayout() helper to be able te switch layouts to app level like sections
- Fixed unknown bug in constructAttributes() where attributes sometime exist without a key or a language code
- Made input labels translatable in input manager. If no translation is present it uses the string in label field as value for default language.
- Provided list of forms in component meta data when in editing mode
- Added Form select in layout builder and linked it with existing form sections
- Added required & attribute column to forms table
- Fixed the translation selector label
- Added "required" & "input_width" inputs in the input manager
- Linked invoice documents in invoice controller (template was missing)
- Added missing translations in invoice template
- Changed base_path() to url('/') in invoice template because of a problem on shared hosting providers

## 0.3.5 - 2021-05-09
- Removed the group_concat_max_len statement caching awaiting a better fix
- Fixed the paper_rip divider
- Fixed the "cache lag" when changing the status of a section. The cache is now being flushed with each status change
- The subject of a general mail (contactaanvraag) will now contain the first field which is posted. Often this will be the name of the user. Example: Contactaanvraag - Jan Janssens
- Fixed a padding issue with btn__text in navigation bar
- Added HEROIG01001 as a footer type
- Refactored parseEditSecAttr() helper to make it much more compacter and scalable
- Properlly connected the map options in layout editor. The states didn't display.
- Made little change to builder.js to make "Extra" attributes display correctly in layout editor
- Reconnected map markers
- Added missing checkContent() for button in HEROVD01001

## 0.3.4 - 2021-05-01
- Connected mail services

## 0.3.3 - 2021-05-01
- Edited AttributeInput model to fix adding inputs flow
- fixed ITMLIST1 used the App namespace
- Added fallback parseContent if value doesn't exist
- Commented an else statement which is possibly redundant (needs to be monitored)
- Reconnected Lightcase font in css
- Added a fallback to the APP_FALLBACK_LOCALE because it was returning null in the constructGlobVars() helper
- Changed the first method to get in getPage mode 2 for the constructTranslatableValues() helper to properly work (it needs a multiple array input even if requesting a single input)

## 0.3.2 - 2021-04-26
- Added "flip layout" to FEATLG09001 & FEATLG09002
- Added "column_alignment" to PRCPST01001
- Extended checkContent helper with a !empty() check
- Added TMLNST01001

## 0.3.1 - 2021-04-25
- Added nunito font
- IG feed will now be cached for a week too prevent blocking by IG
- Fix vertical alignment in TXT1 not saving
- Cropped btns fix

## 0.3.0 - 2021-04-25
- If browser isn't set in a language that isn't defined in the app it will fallback to the first language in the language variable.
- Updated the page migration to conver meta_title, meta_description and meta_keywords columns
- Update helper constructPage to use page specific meta data if provided
- Update Page model to provide logic for the changes above
- Update Content Controller to provide logic for the changes above
- Updated Page add/edit form for changes above
- Moved the constructMenu helper to the Menu model
- Rewritten how routes are generated to include nested routes like created in the navigation menus
- Reintroduced Tfile Cache since Array cache is not a viable option
- Updated the app.php and cache.php config files for changes above
- Updated the main service provider and clean command for changes above
- Updated the breadcrum section to take advantage of the new routing method
- Reset settings session if it was set in admin panel because it have no translations

## 0.2.6 - 2021-04-16
- Added font Alegreya Sans
- creatmenu.blade.php bug fix with storeMenu routing
- Custom scripts now load last in the list
- Changed the z-index of the image upload box to 9999
- Added more colors to text editor
- increased negative value (top/bottom) on divider positioning
- Added Ordered list option in medium editor
- Added Unordered list option in medium editor

## 0.2.5 - 2021-04-11
- Added DatabaseSeeder.php

## 0.2.4 - 2021-04-11
- Refactoring page model
- Refactored migration to seperate seeding
- Added seeders section_items & languages
- Added install for DatabaseSeeder.php
- Edited composer.json to load all package seeders
- Updated dev resources

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
