<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type');
            $table->string('section', 20)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('tags')->nullable();
        });

        DB::table('section_items')->insert([
            array("id" => 1, "type" => 2, "section" => "AI1", "name" => "Accordion Image", "tags" => "accordion"),
            array("id" => 2, "type" => 2, "section" => "AIBG1", "name" => "Accordion Image background", "tags" => "accordion,achtergrond"),
            array("id" => 3, "type" => 3, "section" => "FOOT1", "name" => "Footer 1", "tags" => "footer"),
            array("id" => 4, "type" => 1, "section" => "NAV1", "name" => "Navigation 1", "tags" => "navigation"),
            array("id" => 5, "type" => 2, "section" => "AI2", "name" => "Accordion Image 2", "tags" => "accordion"),
            array("id" => 6, "type" => 2, "section" => "AIBG2", "name" => "Accordion Image background 2", "tags" => "accordion,achtergrond"),
            array("id" => 7, "type" => 2, "section" => "HEROIG01001", "name" => "Cover Text 1", "tags" => "cover,achtergrond"),
            array("id" => 8, "type" => 2, "section" => "HEROIG01002", "name" => "Cover Text 2", "tags" => "cover,achtergrond"),
            array("id" => 9, "type" => 2, "section" => "CVRTXT3", "name" => "Cover Text 3", "tags" => "cover,achtergrond"),
            array("id" => 10, "type" => 2, "section" => "CVRTXT4", "name" => "Cover Text 4", "tags" => "cover,achtergrond"),
            array("id" => 11, "type" => 2, "section" => "CVRTXT5", "name" => "Cover Text 5", "tags" => "cover,achtergrond"),
            array("id" => 13, "type" => 2, "section" => "TXTBG4", "name" => "Text layout background 4", "tags" => "tekst,achtergrond"),
            array("id" => 14, "type" => 2, "section" => "CVRVID1", "name" => "Cover video 1", "tags" => "cover,achtergrond,video"),
            array("id" => 15, "type" => 2, "section" => "MAPTXT1", "name" => "Map text 1", "tags" => "map,tekst"),
            array("id" => 16, "type" => 1, "section" => "NAV2", "name" => "Navigation 2", "tags" => "navigation"),
            array("id" => 17, "type" => 3, "section" => "FOOT2", "name" => "Footer 2", "tags" => "footer"),
            array("id" => 18, "type" => 2, "section" => "ITMLIST1", "name" => "Item list 1", "tags" => "items,list"),
            array("id" => 19, "type" => 1, "section" => "NAV3", "name" => "Navigation 3", "tags" => "navigation"),
            array("id" => 20, "type" => 1, "section" => "LANGNAV1", "name" => "Language Navigation 1", "tags" => "navigation,talen"),
            array("id" => 21, "type" => 2, "section" => "CVRVID2", "name" => "Cover video 2", "tags" => "cover,achtergrond,video"),
            array("id" => 22, "type" => 2, "section" => "MAPIFRCNTC1", "name" => "Map contact Iframe 1", "tags" => "map,contact,iframe"),
            array("id" => 23, "type" => 2, "section" => "CVR1", "name" => "Cover 1", "tags" => "cover,achtergrond"),
            array("id" => 24, "type" => 2, "section" => "TXT1", "name" => "Text Image", "tags" => "tekst"),
            array("id" => 25, "type" => 1, "section" => "NAV4", "name" => "Navigation 4", "tags" => "navigation"),
            array("id" => 26, "type" => 2, "section" => "IGBAN1", "name" => "Instagram banner 1", "tags" => "social"),
            array("id" => 27, "type" => 3, "section" => "FOOTSHORT4", "name" => "Footer Short 4", "tags" => "footer"),
            array("id" => 28, "type" => 3, "section" => "IGBAN1", "name" => "Instagram banner 1", "tags" => "social"),
            array("id" => 29, "type" => 2, "section" => "TXT2", "name" => "Text 1 column", "tags" => "tekst"),
            array("id" => 31, "type" => 2, "section" => "TXTLYT2", "name" => "Text FAQ", "tags" => "tekst,faq"),
            array("id" => 32, "type" => 2, "section" => "TXTLYT3", "name" => "Text FAQ", "tags" => "tekst,faq"),
            array("id" => 33, "type" => 2, "section" => "TXTLYT7", "name" => "Text 4 column", "tags" => "tekst"),
            array("id" => 34, "type" => 2, "section" => "TXTLYT4", "name" => "Text 1 column", "tags" => "tekst"),
            array("id" => 35, "type" => 2, "section" => "TXTLYT5", "name" => "Text 2 column", "tags" => "tekst"),
            array("id" => 36, "type" => 2, "section" => "TXTLYT6", "name" => "Text 3 column", "tags" => "tekst"),
            array("id" => 37, "type" => 2, "section" => "TXTLYT1", "name" => "Text Contact sidebar", "tags" => "tekst,contact"),
            array("id" => 38, "type" => 2, "section" => "IMGLIST1", "name" => "Images list 1", "tags" => "list,gallerij"),
            array("id" => 39, "type" => 2, "section" => "PRCPLN3", "name" => "Pricing plan 3", "tags" => "pricing"),
            array("id" => 40, "type" => 2, "section" => "PRCPLN2", "name" => "Pricing plan 2", "tags" => "pricing"),
            array("id" => 41, "type" => 2, "section" => "PRCPLN4", "name" => "Pricing plan 4", "tags" => "pricing"),
            array("id" => 42, "type" => 2, "section" => "FRMSHRT1", "name" => "Form Short 1", "tags" => "contact"),
            array("id" => 43, "type" => 2, "section" => "CVR2", "name" => "Cover 2", "tags" => "cover,slider"),
            array("id" => 44, "type" => 2, "section" => "PRVCY1", "name" => "Privacy Policy 1", "tags" => "privacy"),
            array("id" => 45, "type" => 2, "section" => "IMGTXTLYT4", "name" => "Image text layout 4", "tags" => "tekst"),
            array("id" => 46, "type" => 2, "section" => "IMGTXTLYT3", "name" => "Image text layout 3", "tags" => "tekst"),
            array("id" => 47, "type" => 2, "section" => "IMGTXTLYT1", "name" => "Image text layout 1", "tags" => "tekst"),
            array("id" => 48, "type" => 2, "section" => "IMGTXTLYT2", "name" => "Image text layout 2", "tags" => "tekst"),
            array("id" => 49, "type" => 2, "section" => "CTAH1", "name" => "CTA horizontal 1", "tags" => "cta"),
            array("id" => 50, "type" => 2, "section" => "CTAH2", "name" => "CTA horizontal 2", "tags" => "cta"),
            array("id" => 51, "type" => 2, "section" => "FEATLG08001", "name" => "Feature Large 8 1 column", "tags" => "feature"),
            array("id" => 52, "type" => 2, "section" => "IMGTXTLYT5", "name" => "Image text layout 5", "tags" => "tekst"),
            array("id" => 53, "type" => 2, "section" => "IMGTXTLYT6", "name" => "Image text layout 6", "tags" => "tekst"),
            array("id" => 54, "type" => 2, "section" => "IMGTXTLYT7", "name" => "Image text layout 7", "tags" => "tekst"),
            array("id" => 55, "type" => 2, "section" => "IMGTXTLYT8", "name" => "Image text layout 8", "tags" => "tekst"),
            array("id" => 56, "type" => 2, "section" => "CTAH3", "name" => "CTA horizontal 3", "tags" => "cta"),
            array("id" => 57, "type" => 2, "section" => "CTAH4", "name" => "CTA horizontal 4", "tags" => "cta"),
            array("id" => 58, "type" => 2, "section" => "CTAH5", "name" => "CTA horizontal 5", "tags" => "cta"),
            array("id" => 59, "type" => 2, "section" => "MAPAPI1", "name" => "Map api fullscreen 1", "tags" => "map"),
            array("id" => 60, "type" => 2, "section" => "MAPIFR1", "name" => "Map iframe fullscreen 1", "tags" => "map,iframe"),
            array("id" => 61, "type" => 2, "section" => "MAPIFR2", "name" => "Map iframe 2", "tags" => "map,iframe"),
            array("id" => 62, "type" => 2, "section" => "MAPAPI2", "name" => "Map api fullscreen 2", "tags" => "map"),
            array("id" => 63, "type" => 2, "section" => "MAPAPICNTC1", "name" => "Map contact api 1", "tags" => "map,contact"),
            array("id" => 64, "type" => 2, "section" => "FRMSHRTTXT1", "name" => "Form Short with sidebar 1", "tags" => "contact"),
            array("id" => 65, "type" => 2, "section" => "FRMLNG1", "name" => "Form Long 1", "tags" => "contact"),
            array("id" => 66, "type" => 2, "section" => "FRMLNGTXT1", "name" => "Form Long with sidebar 1", "tags" => "contact"),
            array("id" => 67, "type" => 1, "section" => "SOCNAV1", "name" => "Social Navigation 1", "tags" => "navigation,social"),
            array("id" => 68, "type" => 3, "section" => "FOOTLNG1", "name" => "Footer long 3 columns", "tags" => "footer"),
            array("id" => 69, "type" => 2, "section" => "FBFEEDIFR1", "name" => "Facebook feed iframe 1", "tags" => "facebook,iframe"),
            array("id" => 70, "type" => 3, "section" => "FBFEEDIFR1", "name" => "Facebook feed iframe 1", "tags" => "facebook,iframe"),
            array("id" => 71, "type" => 3, "section" => "FOOTLNG2", "name" => "Footer long 4 columns", "tags" => "footer"),
            array("id" => 72, "type" => 2, "section" => "ITMLIST2", "name" => "Item list 2", "tags" => "items,list,gallerij"),
            array("id" => 73, "type" => 1, "section" => "CTAH1", "name" => "CTA horizontal 1", "tags" => "cta"),
            array("id" => 74, "type" => 1, "section" => "CTAH2", "name" => "CTA horizontal 2", "tags" => "cta"),
            array("id" => 75, "type" => 1, "section" => "CTAH3", "name" => "CTA horizontal 3", "tags" => "cta"),
            array("id" => 76, "type" => 1, "section" => "CTAH4", "name" => "CTA horizontal 4", "tags" => "cta"),
            array("id" => 77, "type" => 1, "section" => "CTAH5", "name" => "CTA horizontal 5", "tags" => "cta"),
            array("id" => 78, "type" => 3, "section" => "CTAH1", "name" => "CTA horizontal 1", "tags" => "cta"),
            array("id" => 79, "type" => 3, "section" => "CTAH2", "name" => "CTA horizontal 2", "tags" => "cta"),
            array("id" => 80, "type" => 3, "section" => "CTAH3", "name" => "CTA horizontal 3", "tags" => "cta"),
            array("id" => 81, "type" => 3, "section" => "CTAH4", "name" => "CTA horizontal 4", "tags" => "cta"),
            array("id" => 82, "type" => 3, "section" => "CTAH5", "name" => "CTA horizontal 5", "tags" => "cta"),
            array("id" => 83, "type" => 2, "section" => "FEATSM02004", "name" => "Features Small 2", "tags" => "feature"),
            array("id" => 84, "type" => 2, "section" => "FEATSM02003", "name" => "Features Small 2", "tags" => "feature"),
            array("id" => 85, "type" => 2, "section" => "FEATSM02002", "name" => "Features Small 2", "tags" => "feature"),
            array("id" => 86, "type" => 2, "section" => "FEATSM02001", "name" => "Features Small 2", "tags" => "feature"),
            array("id" => 87, "type" => 1, "section" => "SNAVSC01001", "name" => "Sub navigation social and contact 1", "tags" => "navigatie,social,info"),
            array("id" => 88, "type" => 2, "section" => "PRODLS01001", "name" => "Product List 1", "tags" => "producten"),
            array("id" => 89, "type" => 2, "section" => "PRODDT01001", "name" => "Product Detail 1", "tags" => "producten"),
            array("id" => 90, "type" => 2, "section" => "CARTDT01001", "name" => "Cart Detail 1", "tags" => "producten"),
            array("id" => 91, "type" => 2, "section" => "CHKTST01001", "name" => "Checkout 1", "tags" => "producten"),
            array("id" => 92, "type" => 2, "section" => "ORDRDT01001", "name" => "Order detail 1", "tags" => "producten"),
            array("id" => 93, "type" => 2, "section" => "BRNDSL01001", "name" => "Brand Slider 1 ", "tags" => "slider"),
            array("id" => 94, "type" => 2, "section" => "FEATLG08004", "name" => "Feature Large 8 4 column", "tags" => "feature"),
            array("id" => 95, "type" => 2, "section" => "FEATLG08003", "name" => "Feature Large 8 3 column", "tags" => "feature"),
            array("id" => 96, "type" => 2, "section" => "FEATLG08002", "name" => "Feature Large 8 2 column", "tags" => "feature"),
            array("id" => 97, "type" => 2, "section" => "FEATSM03004", "name" => "Features Small 3 4 column", "tags" => "feature"),
            array("id" => 98, "type" => 2, "section" => "FEATSM03003", "name" => "Features Small 3 3 column", "tags" => "feature"),
            array("id" => 99, "type" => 2, "section" => "FEATSM03002", "name" => "Features Small 3 2 column", "tags" => "feature"),
            array("id" => 100, "type" => 2, "section" => "FEATSM03001", "name" => "Features Small 3 1 column", "tags" => "feature"),
            array("id" => 101, "type" => 2, "section" => "PRODFT01001", "name" => "Product Feature 1", "tags" => "product"),
            array("id" => 102, "type" => 2, "section" => "BREADL01001", "name" => "Breadcrum List", "tags" => "breadcrum"),
            array("id" => 103, "type" => 1, "section" => "SNAVSH01001", "name" => "Sub navigation shop", "tags" => "navigatie,webshop"),
            array("id" => 104, "type" => 2, "section" => "PAYMLS01001", "name" => "Payment list 1", "tags" => "webshop"),
            array("id" => 105, "type" => 3, "section" => "PAYMLS01001", "name" => "Payment list 1", "tags" => "webshop"),
            array("id" => 106, "type" => 3, "section" => "BRNDSL01001", "name" => "Brand Slider 1 ", "tags" => "slider")
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_items');
    }
}
