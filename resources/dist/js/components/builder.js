$(document).ready(function() {
	/**
	 *   MediumButton  1.0 (24.02.2015)
	 *   MIT (c) Patrick Stillhart
	 */
	"use strict";function MediumButton(a){if(!(void 0!==a.label&&/\S{1}/.test(a.label)&&void 0!==a.start&&/\S{1}/.test(a.start)&&void 0!==a.end&&/\S{1}/.test(a.end)||void 0!==a.label&&/\S{1}/.test(a.label)&&void 0!==a.action&&/\S{1}/.test(a.action)))return void console.error('[Custom-Button] You need to specify "label", "start" and "end" OR "label" and "action"');a.start=void 0===a.start?"":a.start,a.end=void 0===a.end?"":a.end;var b=this;this.options=a,this.button=document.createElement("button"),this.button.className="medium-editor-action",this.button.innerHTML=a.label,this.button.onclick=function(){var c=getCurrentSelection(),d=window.getSelection(),e=d.anchorNode.parentElement;void 0===a.start||c.indexOf(a.start)==-1&&c.indexOf(a.end)==-1?(void 0!=a.action&&(c=a.action(c,!0,e)),c=a.start+c+a.end):(void 0!=a.action&&(c=a.action(c,!1,e)),c=String(c).split(a.start).join(""),c=String(c).split(a.end).join(""));var g,h;if(d.getRangeAt&&d.rangeCount){if(g=window.getSelection().getRangeAt(0),g.deleteContents(),g.createContextualFragment)h=g.createContextualFragment(c);else{var i=document.createElement("div");for(i.innerHTML=c,h=document.createDocumentFragment();child=i.firstChild;)h.appendChild(child)}var j=h.firstChild,k=h.lastChild;g.insertNode(h),j&&(g.setStartBefore(j),g.setEndAfter(k)),d.removeAllRanges(),d.addRange(g)}b.base.checkContentChanged()}}function getCurrentSelection(){var b,a="";if("undefined"!=typeof window.getSelection){if(b=window.getSelection(),b.rangeCount){for(var c=document.createElement("div"),d=0,e=b.rangeCount;d<e;++d)c.appendChild(b.getRangeAt(d).cloneContents());a=c.innerHTML}}else"undefined"!=typeof document.selection&&"Text"==document.selection.type&&(a=document.selection.createRange().htmlText);return a}MediumButton.prototype.getButton=function(){return this.button},MediumButton.prototype.checkState=function(a){var b=getCurrentSelection();""!=this.options.start&&b.indexOf(this.options.start)>-1&&b.indexOf(this.options.end)>-1?this.button.classList.add("medium-editor-button-active"):this.button.classList.remove("medium-editor-button-active")},"undefined"!=typeof exports&&("undefined"!=typeof module&&module.exports&&(exports=module.exports=MediumButton),exports.MediumButton=MediumButton);

	
	/**
     * Custom `color picker` extension
     */
    var ColorPickerExtension = MediumEditor.extensions.button.extend({
        name: "colorPicker",
        action: "applyForeColor",
        aria: "color picker",
        contentDefault: "<span class='editor-color-picker'><i class='fa fa-tint' aria-hidden='true'></i><span>",

        handleClick: function(e) {
            e.preventDefault();
            e.stopPropagation();

            this.selectionState = this.base.exportSelection();

            // If no text selected, stop here.
            if(this.selectionState && (this.selectionState.end - this.selectionState.start === 0) ) {
              return;
            }

            // colors for picker
            var pickerColors = [ 
              "#1abc9c",
              "#2ecc71",
              "#3498db",
              "#9b59b6",
              "#34495e",
              "#f1c40f",
              "#f39c12",
              "#e67e22",
              "#e74c3c",
              getComputedStyle(document.documentElement).getPropertyValue('--primary-color').slice(0, -2),
              getComputedStyle(document.documentElement).getPropertyValue('--secondary-color').slice(0, -2),
              "#bdc3c7",
              "#95a5a6",
              "#ffffff",
              "#000000"
            ];

            var colorPicker = vanillaColorPicker(this.document.querySelector(".medium-editor-toolbar-active .editor-color-picker"));
            colorPicker.set("customColors", pickerColors);
            colorPicker.set("positionOnTop");
            colorPicker.openPicker();
            colorPicker.on("colorChosen", function(color) {
              this.base.importSelection(this.selectionState);
              this.document.execCommand("styleWithCSS", false, true);
              this.document.execCommand("foreColor", false, color);
            }.bind(this));
        }
    });
	
	/**
     * Custom `icon picker` extension
     */
    var IconPickerExtension = MediumEditor.extensions.button.extend({
        name: "iconPicker",
        action: "pharseIcon",
        aria: "Icon Picker",
        contentDefault: "<span class='editor-icon-picker'><i class='fas fa-icons'>.</i><span>",

        handleClick: function(e) {
            e.preventDefault();
            e.stopPropagation();
			
			//text selection
			this.selectionState = this.base.exportSelection();

            // If no text selected, stop here.
            if(this.selectionState && (this.selectionState.end - this.selectionState.start === 0) ) {
              return;
            }
			
            var iconPicker = customIconPicker(this.document.querySelector(".medium-editor-toolbar-active .editor-icon-picker"));
            //picker.set("customIcons", pickerIcons);
            iconPicker.set("positionOnTop");
            iconPicker.openPicker();
            iconPicker.on("iconChosen", function(icon) {
              this.base.importSelection(this.selectionState);
              //this.document.execCommand("styleWithCSS", false, true);
              //this.document.execCommand("insertHTML", false, "<i class='"+icon+"'></i>");
              //console.log(window.getSelection().getRangeAt(0));
              //this.document.innerHTML = "<i class='"+icon+"'></i>";
              
            var range = window.getSelection().getRangeAt(0);
			range.deleteContents();
			var div = document.createElement("div");
			div.innerHTML = "<i class='"+icon+"'></i>";
			var frag = document.createDocumentFragment(), child;
			while ( (child = div.firstChild) ) {
			    frag.appendChild(child);
			}
			range.insertNode(frag);
              
              iconPicker.destroyPicker();
            }.bind(this));
        }
    });

	var fontSize = MediumEditor.extensions.form.extend({

        name: 'fontsize',
        action: 'fontSize',
        aria: 'increase/decrease font size',
        contentDefault: '&#xB1;', // ±
        contentFA: '<i class="fa fa-text-height"></i>',

        init: function () {
            MediumEditor.extensions.form.prototype.init.apply(this, arguments);
        },

        // Called when the button the toolbar is clicked
        // Overrides ButtonExtension.handleClick
        handleClick: function (event) {
            event.preventDefault();
            event.stopPropagation();
			
            if (!this.isDisplayed()) {
                // Get fontsize of current selection (convert to string since IE returns this as number)
                //var fontSize = this.document.queryCommandValue('fontSize') + '';
				
				var input = null;
                MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
					var className = el.className.match(/(^|\s)f-size-\S+/g);
					if(className !== null){
						input = className.toString();
					}
	            });
	            
	            this.showForm(input);
            }

            return false;
        },

        // Called by medium-editor to append form to the toolbar
        getForm: function () {
            if (!this.form) {
                this.form = this.createForm();
            }
            return this.form;
        },

        // Used by medium-editor when the default toolbar is to be displayed
        isDisplayed: function () {
            return this.getForm().style.display === 'block';
        },

        hideForm: function () {
            this.getForm().style.display = 'none';
            this.getInput().value = '';
        },

        showForm: function (fontSize) {
            var input = this.getInput();

            this.base.saveSelection();
            this.hideToolbarDefaultActions();
            this.getForm().style.display = 'block';
            this.setToolbarPosition();
            
            //gets last character from set class (int)
            if(fontSize !== null){
	            input.value = fontSize.substr(-1);
            }else{
	            input.value = "";
            }
 
            input.focus();
        },

        // Called by core when tearing down medium-editor (destroy)
        destroy: function () {
            if (!this.form) {
                return false;
            }

            if (this.form.parentNode) {
                this.form.parentNode.removeChild(this.form);
            }

            delete this.form;
        },

        // core methods

        doFormSave: function () {
            this.base.restoreSelection();
            this.base.checkSelection();
        },

        doFormCancel: function () {
            this.base.restoreSelection();
            this.clearFontSize();
            this.base.checkSelection();
        },

        // form creation and event handling
        createForm: function () {
            var doc = this.document,
                form = doc.createElement('div'),
                input = doc.createElement('input'),
                close = doc.createElement('a'),
                save = doc.createElement('a');

            // Font Size Form (div)
            form.className = 'medium-editor-toolbar-form';
            form.id = 'medium-editor-toolbar-form-fontsize-' + this.getEditorId();

            // Handle clicks on the form itself
            this.on(form, 'click', this.handleFormClick.bind(this));

            // Add font size slider
            input.setAttribute('type', 'range');
            input.setAttribute('min', '1');
            input.setAttribute('max', '7');
            input.className = 'medium-editor-toolbar-input';
            form.appendChild(input);

            // Handle typing in the textbox
            this.on(input, 'change', this.handleSliderChange.bind(this));

            // Add save buton
            save.setAttribute('href', '#');
            save.className = 'medium-editor-toobar-save';
            save.innerHTML = this.getEditorOption('buttonLabels') === 'fontawesome' ?
                             '<i class="fa fa-check"></i>' :
                             '&#10003;';
            form.appendChild(save);

            // Handle save button clicks (capture)
            this.on(save, 'click', this.handleSaveClick.bind(this), true);

            // Add close button
            close.setAttribute('href', '#');
            close.className = 'medium-editor-toobar-close';
            close.innerHTML = this.getEditorOption('buttonLabels') === 'fontawesome' ?
                              '<i class="fa fa-times"></i>' :
                              '&times;';
            form.appendChild(close);

            // Handle close button clicks
            this.on(close, 'click', this.handleCloseClick.bind(this));

            return form;
        },

        getInput: function () {
            return this.getForm().querySelector('input.medium-editor-toolbar-input');
        },

        clearFontSize: function () {
/*
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
                if (el.nodeName.toLowerCase() === 'font' && el.hasAttribute('size')) {
                    el.removeAttribute('size');
                }
            });
*/
			//this foreach loop gets the right selected element doing it like example below sometimes gets the element outside the editable tag
			//example: var listId = window.getSelection().focusNode.parentNode;
			
			MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {

				var className = el.className.match(/(^|\s)f-size-\S+/g);
				if(className !== null){
					className = className.toString().replace(/\s+/g, '');
					el.classList.remove(className);
				}
            });
        },

        handleSliderChange: function () {
	        this.clearFontSize();
            var size = this.getInput().value;
            var existingClasses = null;
            
            //searches for existing classes
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
				//only selects classlists that are not empty and part of a span to prevent wrong classes being copied like .lead from a parent p tag
				if((el.classList !== null || el.classList !== undefined) && el.tagName.toLowerCase() === "span"){
					existingClasses = el.classList;
				}
            });
            
            //manual span replacement           
            var textNode = window.getSelection().toString();
			var newSpan = document.createElement('span');
			
			//makes sure existing classes are being copied
			if(existingClasses !== null){
				newSpan.classList = existingClasses;
			}
			
			newSpan.classList.add("f-size-"+size);
			newSpan.innerHTML = textNode;
			document.execCommand('insertHTML', true, newSpan.outerHTML);
			this.base.restoreSelection(); //should fix the one time use

        },

        handleFormClick: function (event) {
            // make sure not to hide form when clicking inside the form
            event.stopPropagation();
        },

        handleSaveClick: function (event) {
            // Clicking Save -> create the font size
            event.preventDefault();
            this.doFormSave();
        },

        handleCloseClick: function (event) {
            // Click Close -> close the form
            event.preventDefault();
            this.doFormCancel();
        }
    });
	
var fontName = MediumEditor.extensions.form.extend({

        name: 'fontname',
        action: 'fontName',
        aria: 'change font name',
        contentDefault: '&#xB1;', // ±
        contentFA: '<i class="fa fa-font"></i>',

        fonts: ['', 'var(--body-font)', 'var(--heading-font)'],

        init: function () {
            MediumEditor.extensions.form.prototype.init.apply(this, arguments);
        },

        // Called when the button the toolbar is clicked
        // Overrides ButtonExtension.handleClick
        handleClick: function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (!this.isDisplayed()) {
                // Get FontName of current selection (convert to string since IE returns this as number)
                var fontName = this.document.queryCommandValue('fontName') + '';
                this.showForm(fontName);
            }

            return false;
        },

        // Called by medium-editor to append form to the toolbar
        getForm: function () {
            if (!this.form) {
                this.form = this.createForm();
            }
            return this.form;
        },

        // Used by medium-editor when the default toolbar is to be displayed
        isDisplayed: function () {
            return this.getForm().style.display === 'block';
        },

        hideForm: function () {
            this.getForm().style.display = 'none';
            this.getSelect().value = '';
        },

        showForm: function (fontName) {
            var select = this.getSelect();

            this.base.saveSelection();
            this.hideToolbarDefaultActions();
            this.getForm().style.display = 'block';
            this.setToolbarPosition();

            select.value = fontName || '';
            select.focus();
        },

        // Called by core when tearing down medium-editor (destroy)
        destroy: function () {
            if (!this.form) {
                return false;
            }

            if (this.form.parentNode) {
                this.form.parentNode.removeChild(this.form);
            }

            delete this.form;
        },

        // core methods

        doFormSave: function () {
            this.base.restoreSelection();
            this.base.checkSelection();
        },

        doFormCancel: function () {
            this.base.restoreSelection();
            this.clearFontName();
            this.base.checkSelection();
        },

        // form creation and event handling
        createForm: function () {
            var doc = this.document,
                form = doc.createElement('div'),
                select = doc.createElement('select'),
                close = doc.createElement('a'),
                save = doc.createElement('a'),
                option;

            // Font Name Form (div)
            form.className = 'medium-editor-toolbar-form';
            form.id = 'medium-editor-toolbar-form-fontname-' + this.getEditorId();

            // Handle clicks on the form itself
            this.on(form, 'click', this.handleFormClick.bind(this));

            // Add font names
            for (var i = 0; i<this.fonts.length; i++) {
                option = doc.createElement('option');
                option.innerHTML = this.fonts[i];
                option.value = this.fonts[i];
                select.appendChild(option);
            }

            select.className = 'medium-editor-toolbar-select';
            form.appendChild(select);

            // Handle typing in the textbox
            this.on(select, 'change', this.handleFontChange.bind(this));

            // Add save buton
            save.setAttribute('href', '#');
            save.className = 'medium-editor-toobar-save';
            save.innerHTML = this.getEditorOption('buttonLabels') === 'fontawesome' ?
                             '<i class="fa fa-check"></i>' :
                             '&#10003;';
            form.appendChild(save);

            // Handle save button clicks (capture)
            this.on(save, 'click', this.handleSaveClick.bind(this), true);

            // Add close button
            close.setAttribute('href', '#');
            close.className = 'medium-editor-toobar-close';
            close.innerHTML = this.getEditorOption('buttonLabels') === 'fontawesome' ?
                              '<i class="fa fa-times"></i>' :
                              '&times;';
            form.appendChild(close);

            // Handle close button clicks
            this.on(close, 'click', this.handleCloseClick.bind(this));

            return form;
        },

        getSelect: function () {
            return this.getForm().querySelector('select.medium-editor-toolbar-select');
        },

        clearFontName: function () {
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
                if (el.nodeName.toLowerCase() === 'font' && el.hasAttribute('face')) {
                    el.removeAttribute('face');
                }
            });
        },

        handleFontChange: function () {
            var font = this.getSelect().value;
            if (font === '') {
                this.clearFontName();
            } else {
	            this.execAction('styleWithCSS', true, false);
                this.execAction('fontName', { value: font });
            }
        },

        handleFormClick: function (event) {
            // make sure not to hide form when clicking inside the form
            event.stopPropagation();
        },

        handleSaveClick: function (event) {
            // Clicking Save -> create the font size
            event.preventDefault();
            this.doFormSave();
        },

        handleCloseClick: function (event) {
            // Click Close -> close the form
            event.preventDefault();
            this.doFormCancel();
        }
    });
	
	/**
     * Custom `font picker` extension
     */
	var ParagraphExtension = MediumEditor.extensions.button.extend({
		name: "paragraph",
        action: "pharseParagraph",
        aria: "Paragraph Picker",
        contentDefault: "<span><i class='fas fa-paragraph'></i><span>",
		
		init: function () {
            MediumEditor.extensions.form.prototype.init.apply(this, arguments);
        },
		
        clearFontName: function () {
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {

				var className = el.className.match(/(^|\s)type--\S+/g);
				if(className !== null){
					className = className.toString().replace(/\s+/g, '');
					el.classList.remove(className);
				}
            });
        },

        handleClick: function () {
	        this.base.saveSelection();
            this.clearFontName();
            var name = 'body';
            var existingClasses = null;
            
            //searches for existing classes
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
				//only selects classlists that are not empty and part of a span to prevent wrong classes being copied like .lead from a parent p tag
				if((el.classList !== null || el.classList !== undefined) && el.tagName.toLowerCase() === "span"){
					existingClasses = el.classList;
				}
            });
            
            //manual span replacement           
            var textNode = window.getSelection().toString();
			var newSpan = document.createElement('span');
			
			//makes sure existing classes are being copied
			if(existingClasses !== null){
				newSpan.classList = existingClasses;
			}
			
			newSpan.classList.add("type--"+name+"-font");
			newSpan.innerHTML = textNode;
			document.execCommand('insertHTML', true, newSpan.outerHTML);
			this.base.restoreSelection(); //should fix the one time use
        }
	});
	
	var HeadingExtension = MediumEditor.extensions.button.extend({
		name: "heading",
        action: "pharseHeading",
        aria: "Heading Picker",
        contentDefault: "<span><i class='fas fa-heading'></i><span>",
        
        init: function () {
            MediumEditor.extensions.form.prototype.init.apply(this, arguments);
        },
        
        clearFontName: function () {
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {

				var className = el.className.match(/(^|\s)type--\S+/g);
				if(className !== null){
					className = className.toString().replace(/\s+/g, '');
					el.classList.remove(className);
				}
            });
        },

        handleClick: function () {
	        this.base.saveSelection();
            this.clearFontName();
            var name = 'heading';
            var existingClasses = null;
            
            //searches for existing classes
            MediumEditor.selection.getSelectedElements(this.document).forEach(function (el) {
	            //only selects classlists that are not empty and part of a span to prevent wrong classes being copied like .lead from a parent p tag
				if((el.classList !== null || el.classList !== undefined) && el.tagName.toLowerCase() === "span"){
					existingClasses = el.classList;
				}
            });
            
            //manual span replacement           
            var textNode = window.getSelection().toString();
			var newSpan = document.createElement('span');
			
			//makes sure existing classes are being copied
			if(existingClasses !== null){
				newSpan.classList = existingClasses;
			}
			
			newSpan.classList.add("type--"+name+"-font");
			newSpan.innerHTML = textNode;
			document.execCommand('insertHTML', true, newSpan.outerHTML);
			this.base.restoreSelection(); //should fix the one time use
        }
	});
	
	var CustomEraseExtention = MediumEditor.extensions.button.extend({
		name: "customErase",
        action: "removeFormat",
        aria: "custom remove formatting",
        contentDefault: "<span><i class='fas fa-eraser'></i><span>",
        handleClick: function(e) {
	    	e.preventDefault();
            e.stopPropagation();

            this.selectionState = this.base.exportSelection();
console.log(this.selectionState);
            // If no text selected, stop here.
            if(this.selectionState && (this.selectionState.end - this.selectionState.start === 0) ) {
              return;
            }	

            //remove format
            document.execCommand('removeFormat', true, null);
            
            //tries to remove all other html elements (spans from fontsize and fontname)
            var textNode = window.getSelection().toString(); //doesn't do the last bit? .replace(/&nbsp;/g," ")
			document.execCommand('insertHTML', true, textNode);
            
	    }
	});
	
	var advContentEdit = $('meta[name="content_edit_advanced"]').attr('content');
	
	if(typeof advContentEdit !== "undefined" && advContentEdit){
		var extensions = {
			'colorPicker': new ColorPickerExtension(),
			'iconPicker': new IconPickerExtension(),
			'paragraph': new ParagraphExtension(), 
			'heading': new HeadingExtension(), 
			'fontname': new fontName(), 
			'fontSize': new fontSize(),
			'customErase': new CustomEraseExtention(),
		}
		var buttons = [
			'bold', 
			'italic', 
			'underline', 
			'paragraph', 
			'heading',
			//'fontname', 
			'fontsize',
			'colorPicker', 
			'iconPicker', 
			'anchor',
			"customErase"
		]; //'justifyLeft','justifyCenter','justifyRight','justifyFull',
	}else{
		var extensions = {
			'colorPicker': new ColorPickerExtension()
		}
		var buttons = [
			'bold', 
			'italic', 
			'underline', 
			'colorPicker', 
			'anchor'
		];
	}
	
	var editor = new MediumEditor('data', {
	    toolbar: {
	        /* These are the default options for the toolbar,
	           if nothing is passed this is what is used */
	        allowMultiParagraphSelection: true,
	        buttons: buttons,
	        delay: 0,
	        diffLeft: 0,
	        diffTop: -10,
	        firstButtonClass: 'medium-editor-button-first',
	        lastButtonClass: 'medium-editor-button-last',
	        relativeContainer: null,
	        standardizeSelectionStart: false,
	        static: false,
	        /* options which only apply when static is true */
	        align: 'center',
	        sticky: false,
	        updateOnEmptySelection: false
	    },
	    placeholder: false,
	    spellcheck: false,
	    disableReturn: false,
	    disableDoubleReturn: false,
	    buttonLabels: 'fontawesome',
	    paste:{
		    forcePlainText: true,
		    cleanPastedHTML: false,
		    cleanAttrs: ['class', 'style', 'dir'],
		    cleanTags: ['meta', 'body', 'section', 'aside', 'article','span', 'h1', 'h2', 'font']
		  },
	    anchor: {
	        placeholderText: 'Vul hier uw link in.',
	    },
		extensions: extensions
	});		  


	editor.subscribe("editableKeydownEnter", function (event, element) {
        var node = MediumEditor.selection.getSelectionStart(editor.options.ownerDocument)
        MediumEditor.util.insertHTMLCommand(this.options.ownerDocument, "<br>")
        event.preventDefault()
		//console.log("enter");     
    }.bind(editor));
	
	
	/*
	|
	|	1. GLOBAL VARIABLES 
	|
	*/
	// var attrValues = [ "text-justify", "text-center", "text-right", "space--xxs", "space--xs", "space--sm", "space--md", "space--lg", "space--xlg", "bg--secondary", "bg--dark", "bg--primary", "adjustable--switch","accordion--oneopen", "parallax", "section--ken-burns", "image--light", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" ];
	
	/*!
	 * jQuery UI Touch Punch 0.2.3
	 *
	 * Copyright 2011–2014, Dave Furfero
	 * Dual licensed under the MIT or GPL Version 2 licenses.
	 *
	 * Depends:
	 *  jquery.ui.widget.js
	 *  jquery.ui.mouse.js
	 */
	!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);
	
	//iPAD Support
/*
  $.fn.addTouch = function(){
    this.each(function(i,el){
      $(el).bind('touchstart touchmove touchend touchcancel',function(){
        //we pass the original event object because the jQuery event
        //object is normalized to w3c specs and does not provide the TouchList
        handleTouch(event);
      });
    });

    var handleTouch = function(event)
    {
      var touches = event.changedTouches,
              first = touches[0],
              type = '';

      switch(event.type)
      {
        case 'touchstart':
          type = 'mousedown';
          break;

        case 'touchmove':
          type = 'mousemove';
          event.preventDefault();
          break;

        case 'touchend':
          type = 'mouseup';
          break;

        default:
          return;
      }

      var simulatedEvent = document.createEvent('MouseEvent');
      simulatedEvent.initMouseEvent(type, true, true, window, 1, first.screenX, first.screenY, first.clientX, first.clientY, false, false, false, false, 0, null);
      first.target.dispatchEvent(simulatedEvent);
    };
  };
*/
	
	function constructEditableLinks(){
		$(".btn:not([data-id]):not(.editable-link), .link:not([data-id]):not(.editable-link)").each(function(index){
			var link = $(this).attr('href');
			var key = $(this).attr('data-key');
			var id = $(this).find('data[data-medium-editor-element="true"]').attr('data-id');
			var locale = $(this).find('data[data-medium-editor-element="true"]').attr('data-locale');
			
			if(key == undefined){
				//data-key this is hardcoded maybe find a better solution
				key = "link"
			}
			
			$(this).addClass('editable-link');
			$(this).append('<div class="editable-link-menu"><span class="editable-link-goto" data-link='+link+'><i class="ti-link"></i>Ga naar link</span><span class="editable-link-edit"><i class="ti-settings"></i>Bewerk</span><div class="editable-link-input"><data contenteditable="true" data-id="'+id+'" data-locale="'+locale+'" data-key="'+key+'">'+link+'</data><span class="editable-link-edit-close"><i class="ti-close"></i><span></div></div>');
		});
	};
	constructEditableLinks();
	
	function loadScripts(){
		$('.slider').slick('unslick');
		
		constructEditableLinks();
		sortSections();
		loadBackgrounds();
		loadSliders();
		loadParallax();
		loadYTBGvideo();
		loadMaps();
		loadLightcase();
		loadBlazy();
	};
	
	function constructSectionStatus(){
		$("section").each(function(index){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			
			if(status == 1){
				status = "Zichtbaar";
			}else{
				status = "Onzichtbaar";
			}
			
			if (typeof status !== typeof undefined && status !== false) {
				$(this).append("<div class='se-status' data-id='"+id+"'>"+status+"</div>");
			}
		});
	}
	
	function generateSeEdit(){
		$(".adjustable").each(function(index){
			var id = $(this).attr("data-id");
			var section = $(this).attr("data-section");
			var editable = $(this).attr("data-editable");
			
			if($(this).find('.se-edit').length <= 0){
				$(this).append("<div class='se-edit' data-id='"+id+"' data-section='"+section+"' data-editable='"+editable+"'><i class='stack-cog'></i></div>");
			}
			
		});
	}
	
	function parseResponse(status,msg){
		switch(status) {
		  case 1:
		    $(".builder-message").addClass("succes");
			$(".builder-message").addClass("active");
			$(".builder-message").html("<p><i class='fa fa-check'></i>"+msg+"</p>");
			$(".control-bar span").html("<i class='ti-check'></i>Alle wijzigingen zijn opgeslagen");
			$(".control-bar .btn").removeClass("active");
			$("data").removeClass("edited");
			$(".spinner").removeClass("active");
			
			setTimeout(function(){
				$(".builder-message").addClass("active");
			}, 750);
			setTimeout(function(){
				$(".builder-message").removeClass("active");
			}, 4000);
			setTimeout(function(){
				$(".builder-message").removeClass("succes");
			}, 5000);
		    break;
		  case 0:
		    $(".builder-message").addClass("error");
			$(".builder-message").html("<p><i class='fa fa-times'></i>"+msg+"</p>");
			$(".spinner").removeClass("active");
			
			setTimeout(function(){
				$(".builder-message").addClass("active");
			}, 750);
			setTimeout(function(){
				$(".builder-message").removeClass("active");
			}, 4000);
			setTimeout(function(){
				$(".builder-message").removeClass("error");
			}, 5000);
		    break;
		}
		
	}
	
	function AjaxCall(url, data){
		$.ajax({
			url: url,
			method: 'post',
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {data: data},
			type: 'POST',
			success: function(response) {
				parseResponse(1,"De wijzigingen zijn opgeslagen!");
			},
			error: function (xhr, ajaxOptions, thrownError) {
		        parseResponse(0,"Oeps! er liep iets verkeerd...");
		    }
		});
	};
	
	function ChangeColor(color, percent) {
		var num = parseInt(color.replace("#",""),16),
		amt = Math.round(2.55 * percent),
		R = (num >> 16) + amt,
		B = (num >> 8 & 0x00FF) + amt,
		G = (num & 0x0000FF) + amt;
		return "#" + (0x1000000 + (R<255?R<1?0:R:255)*0x10000 + (B<255?B<1?0:B:255)*0x100 + (G<255?G<1?0:G:255)).toString(16).slice(1);
	};
	
	function sortSections(){
		var list = Array();
		var hI = 1;
		$("header .manageable").each(function(index){
			var listItem ={
				"id":$(this).attr("data-id"),
				"position": hI
			};
			list.push(listItem);
			hI++;
		});
		
		var mI = 1;
		$("main .manageable").each(function(index){
			var listItem ={
				"id":$(this).attr("data-id"),
				"position": mI
			};
			list.push(listItem);
			mI++;
		});
		
		var fI = 1;
		$("footer .manageable").each(function(index){
			var listItem ={
				"id":$(this).attr("data-id"),
				"position": fI
			};
			list.push(listItem);
			fI++;
		});
		
		var dataArray = JSON.stringify(list);
		
		$.ajax({
		   url: "/admin/content/order/sections",
		   data: {data: dataArray},
		   type: 'POST',
		   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		   success: function(r) {
	
		   }
		});
	};
	
	function ReloadSection(){
		var id = $(".se-edit-menu").attr("data-id");
		var elem = ".adjustable[data-id='"+id+"']";
		
		$(elem).load(location.href + " " + elem, function(response, status, xhr) {
			//unwrap parent element to prevent parent duplicating
			if(status == 'success'){
				$(this).find(".adjustable").unwrap();
				generateSeEdit();
				loadScripts();
			}else{
				//Something went wrong reload the whole page!
				location.reload();
			}
		});
	}
	
	function saveContent(){
		$(".spinner").addClass("active");
		var list = new Array();
		$("data.edited").each(function(index){
			var listItem ={
				"id":$(this).attr("data-id"),
				"module":$(this).attr("data-module"),
				"locale":$(this).attr("data-locale"),
				"key":$(this).attr("data-key"),
				"value":$(this).html(),
			};
			list.push(listItem);
		});
	
	    var dataArray = JSON.stringify(list);
	
		AjaxCall("/admin/content/update/fields", dataArray);
	};
	
	function toggleStatus(e){
		var id  = e.attr('data-id');
		var status = e.closest('section').attr('data-status');
		var statusText;
		
		switch(status) {
		  case '0':
		    status = 1;
		    statusText = "Zichtbaar";
		    break;
		  case '1':
		    status = 0;
		    statusText = "Onzichtbaar";
		    break;
		}
		
		var list = {
			"id":id,
			"status":status
		};
		
	    var dataArray = JSON.stringify(list);
	
		AjaxCall("/admin/content/status/section", dataArray);
		
		e.text(statusText);
		e.closest('section').attr('data-status',status);
	};
	
	function closeAll(){
		$(".se-overlay").removeClass("active");
		$(".se-edit-menu").removeClass("active");
		$(".se-section-list").removeClass("active");
		$(".spinner").addClass("active");
		$(".adjustable").removeClass("transparant");
		$(".manageable").removeClass("transparant");
		$(".manageable-placeholder").removeClass("active");
		$(".manageable-placeholder.remove").remove();
	};
	
	function constructInputSelect(){
		var metaData = $('meta[name="inputs"]').attr('content');
		var options = "";
		var optionsLi = "";
		
		if(typeof metaData !== "undefined" && metaData){	
			var items = JSON.parse(metaData);	  
			$.each(items, function(index, element) {
				options += "<optgroup label='"+index+"'>";
				options += "<option value=''>Geen input</option>";
				$.each(element, function(i, e){
					options += "<option value='"+i+"'>"+e+"</option>";
					optionsLi += "<li value='"+i+"'>"+e+"</li>"; //necessary?
				});
				options += "</optgroup>";
			});
		}
		
		return options;
	}
	
	/*
	|
	|	2. CONSTRUCT THE BUILDER ELEMENTS 
	|
	*/
	
	constructSectionStatus();
	generateSeEdit();
	
	$("body").append("<div class='se-edit-menu'><div class='se-close'><i class='stack-left-open-big'></i><p>Sluit</p></div><hr><div class='se-edit-items'></div></div><div class='se-overlay'></div>");
	$("body").append('<div id="se-edit-images"></div>');
	
	$("body").append("<div class='builder-message'></div>");
	
	//$("body").append('<svg class="spinner" width="30px" height="30px" viewBox="0 0 70 70" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="10" stroke-linecap="round" cx="35" cy="35" r="30"></circle></svg>');
	
	$("body").append('<div class="se-section-list"></div>');
	
	//if($('meta[name="layout_editor"]').attr('content') == "1"){	
		$(".background-image-holder").each(function(index){
			var imgSrc = $(this).find('img').attr("src");
			var imgId = $(this).find('img').attr("data-id");
			
			$(this).append('<a href="#" class="btn btn--rounded bg-img-edit" src="'+imgSrc+'" data-id="'+imgId+'"><i class="ti-save"></i>Achtergrond afbeelding wijzigen</a>');
		});
	//}
	
	if($('meta[name="autosave"]').attr('content') !== "1"){
		var saveBtn = '<a href="#" id="save-content" class="btn btn--rounded">Wijzigingen opslaan</a><hr>';
	}else{
		var saveBtn = '';
	}
	
	$("body").append('<div class="control-bar"><div class="control-bar-left"><i class="undo link ti-back-left"></i><i class="redo link ti-back-right"></i><hr>'+saveBtn+'<span></span><svg class="spinner" width="30px" height="30px" viewBox="0 0 70 70" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="10" stroke-linecap="round" cx="35" cy="35" r="30"></circle></svg></div><div class="control-bar-right"><a href="/admin" class="link"><i class="fa fa-list"></i></a><a href="/admin/settings" class="link"><i class="fa fa-cog"></i></a></div></div>');
	
	/*
	|
	|	3. ATTRIBUTE CONSTRUCTION 
	|
	*/
	
	/**
	  * sectionBuilder(options)
	  *
	  * @check bool 	| (default false)
	  * @construct bool | (default false)
	  * @save bool 		| (default false) !only works if construct is true otherwise it saves empty outputs!
	*/
	
	function sectionBuilder(options){
		var id = $(".se-edit-menu").attr("data-id");
	
		//Empty data values that are used to construct and save the data in database
		var data = Array();
		
		$(".se-edit-item").each(function(index){
			
			var t = $(this).attr("type");
			var e = $(this).attr("element");
			var a = $(this).attr("attribute");
			
			//sets the correct selector (defaults to adjustable)
		  	if(e == undefined){
			  	var ed = ".adjustable"; //stores the element for use in the dataset
			    e = $(".adjustable[data-id='"+id+"']"); //element
		    }else{
			    var ed = e; //stores the element for use in the dataset
			    var es = $(".adjustable[data-id='"+id+"']"); //element section
			    e = $(".adjustable[data-id='"+id+"']").find(e); //element
		    }
			
			$(this).find("li").each(function(index){
				var v = $(this).attr("value");
				
				if (options.check) {
					switch(t) {
					  case "extra":
					  	//mainly to get the right value in range inputs
					    var cv = es.attr("data-"+ed);
					    break;
					  case "attribute":
					  	var cv = e.attr(a);
					  	
					    break;
					  case "class":
					  	var cv = e.attr("class");
					  	
						break;
					}
					
					if(t == "attribute"){
						if(cv !== undefined && cv == v){ //cv.indexOf(v) > -1 (changed to get exact value. had some problems with range maps zoom)
							$(this).addClass("active");
						}else{
							$(this).removeClass("active");
						}
					}else{
						if(cv !== undefined && cv.indexOf(v) > -1){ 
							$(this).addClass("active");
						}else{
							$(this).removeClass("active");
						}
					}
					
					
				}
				
				if (options.construct) {
					switch(t) {
					  case "extra":
					  	//console.log(ed+':'+v);
					  	
					  	if($(this).hasClass('active')){
							$(".adjustable[data-id='"+id+"']").attr("data-"+ed,v);
						}
					    break;
					  case "attribute":
					  	//gives the attribute the value of the active element
					   	if($(this).hasClass('active')){
							e.attr(a,v);
							v = a+"='"+v+"'"; //construct value for dataset
						}
					    break;
					  case "class":
					  	//gives the proper value and resets non-active values
					    if($(this).hasClass('active')){
							e.addClass(v);
						}else{
							e.removeClass(v);
						}
						break;
					}
					
					if($(this).hasClass('active') && v !== ""){
						data.push({"type":t, "element":ed, "value":v});
					}
				}
			});
			
			//GENERAL CHECKUPS
			//Only when no attribute is active give the active class to an empty value option (default option)
			if($(this).find("li.active").length == 0){
				if($(this).find("li[value='']")){
					$(this).find("li[value='']").addClass("active"); //give to empty value
				}else{
					//$(this).find("li:nth-child(1)").addClass("active"); //if no empty value give to first
				}
			}
			// If active class is set remove default active
			if($(this).find("li.active").length == 2){
				$(this).find("li[value='']").removeClass("active");
			}
			
			//makes sure that the pointers are adjusted to the right value
			$(".range").each(function(index){
				var val = $(this).parent().find("li.active").attr("range");
				$(this).val(val);
			});
			
			//makes sure that the switch has the correct visual presentation
			$(".switch").each(function(index){
				if($(this).parent().find("li:first-child").hasClass('active')){
					$(this).removeClass("active");
				}else{
					$(this).addClass("active");
				}
			});
			
			if($(this).find(".select").length > 0){
				var setValue = $(".adjustable[data-id='"+id+"']").attr("data-"+ed);
				var valueCheck = 0;
				
				$(this).find("option").each(function(index){
					if($(this).is(':selected') && $(this).val() !== undefined && !$(this).val() && $(this).val().length !== 0){
						//console.log($(this).val());
						var value = $(this).val();
						$(".adjustable[data-id='"+id+"']").attr("data-"+ed,value);
						$(this).parent().find("option").attr("selected",false);
						$(this).attr("selected",true);
						valueCheck = 1;
					}
				});
				
				//if none is checked define the setValue (default)
				if(valueCheck == 0 && setValue !== undefined){
					$(this).find("option").attr("selected",false);
					$(this).find("option[value='"+setValue+"']").attr("selected",true);
					$(this).closest(".se-edit-item").find("li").attr("value",setValue);
				}
			}
			
			if($(this).find(".input").length > 0){
				var setValue = $(".adjustable[data-id='"+id+"']").attr("data-"+ed);
				var valueCheck = 0;
				
				var value = $(this).find(".input").val();
				$(".adjustable[data-id='"+id+"']").attr("data-"+ed,value);
			}

			if($(this).find(".select").length == 1){
				$(this).find('li').addClass('active');
			}
			
		});
		
		if(options.save) {
			//console.log(dataArray);
			var dataArray = JSON.stringify(data);
			AjaxCall("/admin/content/"+id+"/update/section/attributes", dataArray);
		}
		
	}
	
	$(document).on('click', '.se-edit', function () {
		var id = $(this).attr("data-id");
		var section = $(this).attr("data-section");
		var editable = $(this).attr("data-editable");
		
		$(".se-edit-menu").addClass("active");
		$(".se-overlay").addClass("active");
		$(".se-edit-menu").attr("data-id",id);
		$(".adjustable:not([data-id='"+id+"'])").addClass("transparant");
		
		var data = JSON.parse(editable);

		$(".se-edit-items").html('');
		
		//construct categories
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-layout"></b>Layout<i class="ti-angle-left"></i></p><hr><div data-category="layout"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-image"></b>Achtergrond<i class="ti-angle-left"></i></p><hr><div data-category="background"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-line-double"></b>Dividers<i class="ti-angle-left"></i></p><hr><div data-category="dividers"></div></div>');
		
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-menu"></b>Menu<i class="ti-angle-left"></i></p><hr><div data-category="menu"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-panel"></b>Items<i class="ti-angle-left"></i></p><hr><div data-category="items"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-layout-media-overlay-alt"></b>Footer<i class="ti-angle-left"></i></p><hr><div data-category="footer"></div></div>');
		
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-layout-accordion-separated"></b>Accordion<i class="ti-angle-left"></i></p><hr><div data-category="accordion"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-layout-slider"></b>Slider<i class="ti-angle-left"></i></p><hr><div data-category="slider"></div></div>');
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-map-alt"></b>Maps<i class="ti-angle-left"></i></p><hr><div data-category="maps"></div></div>');
		
		$(".se-edit-items").append('<div class="se-edit-category"><p><b class="ti-panel"></b>Overig<i class="ti-angle-left"></i></p><hr><div data-category="misc"></div></div>');
		
		var fCC = 1; //footer column content
		$.each(data, function(index, element) {
		    //console.log(element);
	
		    switch(element) {
			  case "text_alignment":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Uitlijning</p><ul class='se se-ic' col='4'><li value=''><span class='oi' data-glyph='align-left'></span></li><li value='text-justify'><span class='oi' data-glyph='justify-left'></span></li><li value='text-center'><span class='oi' data-glyph='align-center'></span></li><li value='text-right'><span class='oi' data-glyph='align-right'></span></li></ul></div><hr>");
			    break;
/*
			  case "text_alignment_element":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.row'><p>Uitlijning</p><ul class='se se-ic' col='4'><li value=''><span class='oi' data-glyph='align-left'></span></li><li value='text-justify'><span class='oi' data-glyph='justify-left'></span></li><li value='text-center'><span class='oi' data-glyph='align-center'></span></li><li value='text-right'><span class='oi' data-glyph='align-right'></span></li></ul></div><hr>");
			    break;
*/
			  case "text_alignment_row":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.row--e'><p>Uitlijning</p><ul class='se se-ic' col='4'><li value=''><span class='oi' data-glyph='align-left'></span></li><li value='text-justify'><span class='oi' data-glyph='justify-left'></span></li><li value='text-center'><span class='oi' data-glyph='align-center'></span></li><li value='text-right'><span class='oi' data-glyph='align-right'></span></li></ul></div><hr>");
			    break;
			  case "section_padding":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Spatiëren</p><input class='range' type='range' min='0' max='7' value='4' title='Spatiëren'><ul class='se-ra' col='8'><li value='space--0' range='0'>0</li><li value='space--xxs' range='1'>XXS</li><li value='space--xs' range='2'>XS</li><li value='space--sm' range='3'>SM</li><li value='' range='4'>Auto</li><li value='space--md' range='5'>MD</li><li value='space--lg' range='6'>LG</li><li value='space--xlg' range='7'>XLG</li></ul></div><hr>");
			    break;
			  case "section_padding_sm":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Spatiëren</p><input class='range' type='range' min='0' max='5' value='4' title='Spatiëren'><ul class='se-ra' col='6'><li value='py-0' range='0'>0</li><li value='py-1' range='1'>XXS</li><li value='py-2' range='2'>XS</li><li value='py-3' range='3'>SM</li><li value='py-4' range='4'>MD</li><li value='py-5' range='5'>LG</li></ul></div><hr>");
			    break;
			  case "background":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class'><p>Achtergrond</p><ul class='se se-co' col='5'><li value=''><span class='bg--white'></span></li><li value='bg--secondary'><span class='bg--secondary'></span></li><li value='bg--dark'><span class='bg--dark'></span></li><li value='bg--primary'><span class='bg--primary'></span></li><li value='bg--gradient'><span class='bg--primary gradient'></span></li></ul></div><hr>");
			  	break;
			  case "element_background":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.e'><p>Element Achtergrond</p><ul class='se se-co' col='4'><li value=''><span class='bg--white'></span></li><li value='bg--secondary'><span class='bg--secondary'></span></li><li value='bg--dark'><span class='bg--dark'></span></li><li value='bg--primary'><span class='bg--primary'></span></li></ul></div><hr>");
			  	break;
			  case "background_image":
			  	var img = $(".adjustable[data-id='"+id+"'] .background-image-holder img");
			  	var imgId = img.attr('data-id');
			  	var imgSrc = img.attr('src');
			  	
			  	var imgElem = '<img src="'+imgSrc+'" contenteditable="true" data-id="'+imgId+'">';
			  	
			  	$("div[data-category='background']").append("<div class='se-edit-item'><p>Achtergrond Afbeelding</p>"+imgElem+"</div><hr>");
			  	break;
			  case "background_position_x":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.background-image-holder'><p>Achtergrond positie X</p><ul class='se se-ic' col='3'><li value='background-pos-x-left'>Left</li><li value='background-pos-x-center'>Center</li><li value='background-pos-x-right'>Right</li></ul></div><hr>");
			  	break;
			  case "background_position_y":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.background-image-holder'><p>Achtergrond positie X</p><ul class='se se-ic' col='3'><li value='background-pos-y-top'>Top</li><li value='background-pos-y-center'>Center</li><li value='background-pos-y-bottom'>Bottom</li></ul></div><hr>");
			  	break;
			  case "granim_background":
			  	var primary_color = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').slice(0, -2);
			  	var secondary_color = getComputedStyle(document.documentElement).getPropertyValue('--secondary-color').slice(0, -2);
			  	var colors = ChangeColor(primary_color,10)+','+primary_color+','+secondary_color+','+ChangeColor(secondary_color,-10);
			  	$("div[data-category='background']").append("<div class='se-edit-item se-edit-reload' type='attribute' attribute='data-gradient-bg'><p>Geanimeerde gradient</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='"+colors.replace(/\s/g, '')+"'></li></ul></div><hr>");
			    break;
			  case "nav_background":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.bar'><p>Achtergrond</p><ul class='se se-co' col='3'><li value=''><span class='bg--white'></span></li><li value='bg--secondary'><span class='bg--secondary'></span></li><li value='bg--dark'><span class='bg--dark'></span></li></ul></div><hr>");
			  	break;
			  case "nav_background_transparant":
			  	$("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.bar'><p>Transparante navigatie</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='bar--absolute bar--transparent'></li></ul></div><hr>");
			  	break;
			  case "nav_sticky":
			  	$("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Sticky navigatie</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='nav-sticky'></li></ul></div><hr>");
			  	break;
			  case "nav_shadow":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.bar'><p>Navigatie schaduw</p><ul class='se se-ic' col='4'><li value=''>Off</li><li value='box-shadow-shallow'>SM</span></li><li value='box-shadow-realistic'>MD</span></li><li value='box-shadow-wide'>LG</li></ul></div><hr>");
			    break;	
			  case "logo_light":
			  	$("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.logo'><p>Logo Light</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='logo-white'></li></ul></div><hr>");				
			  	break;
			  case "overlap_layout":
			  	$("div[data-category='layout']").append("<div class='se-edit-item se-edit-reload' type='class' element='.container'><p>Overlap layout</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='overlap-top-100'></li></ul></div><hr>");				
			  	break;
			  case "flip_layout":
			  	$("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Flip Layout</p><ul class='se se-tx' col='2'><li value=''>Origineel</li><li value='switchable--switch'>Flipped</li></ul></div><hr>");
			  	break;
			  case "accordion_panels":
			  	$("div[data-category='accordion']").append("<div class='se-edit-item' type='class' element='.accordion'><p>Accordion Panelen</p><ul class='se se-tx' col='2'><li value=''>Meerdere open</li><li value='accordion--oneopen'>één open</li></ul></div><hr>");
			  	break;
			  case "parallax":
			  	$("div[data-category='background']").append("<div class='se-edit-item se-edit-reload' type='class'><p>Parallax</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='parallax'></li></ul></div><hr>");
			  	break;
			  case "background_effect":
			  	$("div[data-category='background']").append("<div class='se-edit-item se-edit-reload' type='class'><p>Achtergrond Effect</p><ul class='se se-tx' col='3'><li value=''>Geen</li><li value='parallax'>Parallax</li><li value='section--ken-burns'>Ken Burns</li></ul></div><hr>");
			  	break;
			  case "invert_colours":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class'><p>Inverteer kleuren</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='image--light'></li></ul></div><hr>");
			  	break;
			  case "element_invert_colours":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.e'><p>Inverteer kleuren</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='image--light'></li></ul></div><hr>");
			  	break;
			  case "image_overlay":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='attribute' attribute='data-overlay'><p>Overlay Helderheid</p><input class='range' type='range' min='0' max='9' value='4' title='Overlay Helderheid'><ul class='se-ra' col='10'><li value='0' range='0'>Off</li><li value='1' range='1'></li><li value='2' range='2'></li><li value='3' range='3'></li><li value='4' range='4'></li><li value='5' range='5'></li><li value='6' range='6'></li><li value='7' range='7'></li><li value='8' range='8'></li><li value='9' range='9'>Full</li></ul></div><hr>");
			  	break;
			  case "slide_arrows":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
				  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-arrows'><p>Slider Pijlen</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value='false'></li><li value='true'></li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_paging":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
				  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-paging'><p>Slider Dots</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value='false'></li><li value='true'></li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_speed":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
			  		$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-autospeed'><p>Slider Speed</p><input class='range' type='range' min='0' max='8' value='4' title='Slider Speed'><ul class='se-ra' col='9'><li value='2000' range='0'>2000</li><li value='3000' range='1'></li><li value='4000' range='2'></li><li value='5000' range='3'>5000</li><li value='6000' range='4'></li><li value='7000' range='5'></li><li value='8000' range='6'></li><li value='9000' range='7'></li><li value='10000' range='8'>10000</li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_transition":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
				  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-fade'><p>Slider transition</p><ul class='se se-tx' col='2'><li value='true'>Fade</li><li value='false'>Slide</li></ul></div><hr>");
			  	}
			    break;
			  case "slide_sts":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
			  		$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-slidestoshow'><p>Slider slides to show</p><input class='range' type='range' min='0' max='6' value='4' title='Slider slides to show'><ul class='se-ra' col='7'><li value='1' range='0'>1</li><li value='2' range='1'>2</li><li value='3' range='2'>3</li><li value='4' range='3'>4</li><li value='5' range='4'>5</li><li value='6' range='5'>6</li><li value='7' range='6'>7</li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_center_padding":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
			  		$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-centerpadding'><p>Slider Center Padding</p><input class='range' type='range' min='0' max='4' value='4' title='Slider Center Padding'><ul class='se-ra' col='5'><li value='20px' range='0'>20</li><li value='40px' range='1'>40</li><li value='60px' range='2'>60</li><li value='80px' range='3'>80</li><li value='100px' range='4'>100</li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_slides_padding":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
			  		$("div[data-category='slider']").append("<div class='se-edit-item' type='class' element='.img'><p>Slider Slide Padding</p><input class='range' type='range' min='0' max='5' value='4' title='Slider Slide Padding'><ul class='se-ra' col='6'><li value='' range='0'>0</li><li value='mx-1' range='1'>1</li><li value='mx-2' range='2'>2</li><li value='mx-3' range='3'>3</li><li value='mx-4' range='4'>4</li><li value='mx-5' range='5'>5</li></ul></div><hr>");
			  	}
			  	break;
			  case "slide_center_mode":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
				  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-centermode'><p>Slider center mode</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value='false'></li><li value='true'></li></ul></div><hr>");
			  	}
			    break;
			  case "slide_autoplay":
			  	if($(".adjustable[data-id='"+id+"'] .slider").length > 0){
				  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-autoplay'><p>Slider Autoplay</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value='false'></li><li value='true'></li></ul></div><hr>");
			  	}
			    break;  
			  case "section_height":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class'><p>Sectie Hoogte</p><input class='range' type='range' min='0' max='8' value='5' title='Sectie Hoogte'><ul class='se-ra' col='9'><li value='height-auto' range='0'>Auto</li><li value='height-30' range='1'></li><li value='height-40' range='2'></li><li value='height-50' range='3'></li><li value='height-60' range='4'></li><li value='height-70' range='5'></li><li value='height-80' range='6'></li><li value='height-90' range='7'></li><li value='height-100' range='8'>100%</li></ul></div><hr>");
			    break;
			  case "element_overlay":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='attribute' attribute='data-overlay' element='.e'><p>Overlay Helderheid</p><input class='range' type='range' min='0' max='9' value='4' title='Overlay Helderheid'><ul class='se-ra' col='10'><li value='0' range='0'>Off</li><li value='1' range='1'></li><li value='2' range='2'></li><li value='3' range='3'></li><li value='4' range='4'></li><li value='5' range='5'></li><li value='6' range='6'></li><li value='7' range='7'></li><li value='8' range='8'></li><li value='9' range='9'>Full</li></ul></div><hr>");
			  	break;
			  case "element_height":
			    $("div[data-category='layout']").append("<div class='se-edit-item' type='class' element='.e'><p>Element Hoogte</p><input class='range' type='range' min='0' max='8' value='5' title='Element Hoogte'><ul class='se-ra' col='9'><li value='height-auto' range='0'>Auto</li><li value='height-30' range='1'></li><li value='height-40' range='2'></li><li value='height-50' range='3'></li><li value='height-60' range='4'></li><li value='height-70' range='5'></li><li value='height-80' range='6'></li><li value='height-90' range='7'></li><li value='height-100' range='8'>100%</li></ul></div><hr>");
			    break;
			  case "element_width":
			    $("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.e'><p>Element Breedte</p><input class='range' type='range' min='0' max='8' value='5' title='Element Hoogte'><ul class='se-ra' col='9'><li value='width-auto' range='0'>Auto</li><li value='width-30' range='1'></li><li value='width-40' range='2'></li><li value='width-50' range='3'></li><li value='width-60' range='4'></li><li value='width-70' range='5'></li><li value='width-80' range='6'></li><li value='width-90' range='7'></li><li value='width-100' range='8'>100%</li></ul></div><hr>");
			    break;
			  case "element_shadow":
			    $("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.e'><p>Element schaduw</p><ul class='se se-ic' col='4'><li value=''>Off</li><li value='box-shadow-shallow'>SM</span></li><li value='box-shadow-realistic'>MD</span></li><li value='box-shadow-wide'>LG</li></ul></div><hr>");
			    break;
			  case "element_columns":
			    $("div[data-category='misc']").append("<div class='se-edit-item se-edit-reload' type='class' element='.e'><p>Aantal kolommen</p><input class='range' type='range' min='0' max='3' value='0' title='Aantal kolommen'><ul class='se-ra' col='4'><li value='col-12' range='0'>1</li><li value='col-md-6' range='1'>2</li><li value='col-md-4' range='2'>3</li><li value='col-md-3' range='3'>4</li></ul></div><hr>");
			    break;
			  case "element_border":
			  	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.e'><p>Element Border</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='boxed--border'></li></ul></div><hr>");
			  	break;
			  case "background_alignment":
			  	$("div[data-category='background']").append("<div class='se-edit-item' type='class' element='.background-image-holder'><p>Achtergrond uitlijning</p><ul class='se se-tx' col='3'><li value='background--bottom'>Bottom</li><li value=''>Center</li><li value='background--top'>top</li></ul></div><hr>");
			    break;
/*
			  case "item_":
			  	$("div[data-category='slider']").append("<div class='se-edit-item' type='attribute' element='.slider' attribute='data-paging'><p>Slider Dots</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value='false'></li><li value='true'></li></ul></div><hr>");
			  	break;
*/
			  case "item_select":
			   	  var metaData = $('meta[name="items"]').attr('content');
			   	  
			   	  if(typeof metaData !== "undefined" && metaData){
				   	  var items = JSON.parse(metaData);
				 
					  var options = "";
					  var optionsLi = "";
					  options += "<option value=''>Geen items</option>";
					  $.each(items, function(index, element) {
						  options += "<option value='"+index+"'>"+element+"</option>";
						  optionsLi += "<li value='"+index+"'>"+element+"</li>";
					  });
					  
					  $("div[data-category='items']").append("<div class='se-edit-item se-edit-reload' type='extra' element='item_id'><p>Items</p><select class='select'><option value='' disabled selected>Selecteer een item</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
			   	  }
				  
			    break;
			  case "input_select_title":
				  var options = constructInputSelect();
				  if(typeof options !== "undefined" && options){
					  $("div[data-category='items']").append("<div class='se-edit-item se-edit-reload' type='extra' element='item_title'><p>Items Titel</p><select class='select item-input-select'><option value='' disabled selected>Selecteer een waarde</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
				  }
			    break;
			  case "input_select_text":
				  var options = constructInputSelect();
				  
				  if(typeof options !== "undefined" && options){
				  	$("div[data-category='items']").append("<div class='se-edit-item se-edit-reload' type='extra' element='item_text'><p>Items Tekst</p><select class='select item-input-select'><option value='' disabled selected>Selecteer een waarde</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
				  }
			    break;
			  case "item_page_select":
			  	  var metaData = $('meta[name="pages"]').attr('content');
			   	  
			   	  if(typeof metaData !== "undefined" && metaData){
					  var pages = JSON.parse(metaData);
					  
					  var options = "";
					  var optionsLi = "";
					  options += "<option value=''>Geen pagina</option>";
					  $.each(pages, function(index, element) {
						  options += "<option value='"+index+"'>"+element+"</option>";
						  optionsLi += "<li value='"+index+"'>"+element+"</li>";
					  });
					  
					  $("div[data-category='items']").append("<div class='se-edit-item se-edit-reload' type='extra' element='item_page'><p>Item pagina</p><select class='select'><option value='' disabled selected>Selecteer een pagina</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
				  }
			    break;
			  case "item_limit":
			  	$("div[data-category='items']").append("<div class='se-edit-item se-edit-reload' type='extra' element='item_limit'><p>Item aantal</p><input class='range' type='range' min='0' max='6' value='0' title='Item aantal'><ul class='se-ra' col='7'><li value='1' range='0'>1</li><li value='2' range='1'>2</li><li value='3' range='2'>3</li><li value='4' range='3'>4</li><li value='6' range='4'>6</li><li value='8' range='5'>8</li><li value='' range='6'>∞</li></ul></div><hr>");
			  	break;
			  case "background_video":
			  	if($(".adjustable[data-id='"+id+"']").length > 0){
				  	var val = $(".adjustable[data-id='"+id+"']").attr('data-youtube');
				  	
				  	if(val == undefined){
					  	val = "";
				  	}
			  	}
			  	$("div[data-category='background']").append("<div class='se-edit-item se-edit-reload' type='extra' element='youtube'><p>Achtergrond Video</p><input type='text' value='"+val+"' class='input'><li class='hidden' value='"+val+"'></li></div><hr>");
			    break;
/*
			   case "section_id":
			  	if($(".adjustable[data-id='"+id+"']").length > 0){
				  	var val = $(".adjustable[data-id='"+id+"']").attr('id');
				  	
				  	if(val == undefined){
					  	val = "";
				  	}
			  	}
			  	$(".se-edit-items").append("<div class='se-edit-item se-edit-reload' type='extra' element='id'><p>Section ID</p><input type='text' value='"+val+"' class='input'><li class='hidden' value='"+val+"'></li></div><hr>");
			    break;
*/
			   case "logo_size":
			   	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.logo'><p>Grote Logo</p><input class='range' type='range' min='0' max='3' value='0' title='Grote Logo'><ul class='se-ra' col='4'><li value='' range='0'>SM</li><li value='logo--md' range='1'>MD</li><li value='logo--lg' range='2'>LG</li><li value='logo--xlg' range='3'>XLG</li></ul></div><hr>");
			   	break;
			   case "image_border_radius":
			  	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding afronding</p><input class='range' type='range' min='0' max='8' value='0' title='Overlay Helderheid'><ul class='se-ra' col='9'><li value='' range='0'>Off</li><li value='border-radius-4' range='1'>4</li><li value='border-radius-6' range='2'>6</li><li value='border-radius-8' range='3'>8</li><li value='border-radius-10' range='4'>10</li><li value='border-radius-15' range='5'>15</li><li value='border-radius-25' range='6'>25</li><li value='border-radius-50' range='7'>50</li><li value='border-radius-150' range='8'>150</li></ul></div><hr>");
			  	break;
			  case "image_padding":
			  	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding padding</p><input class='range' type='range' min='0' max='5' value='0' title='Afbeelding padding'><ul class='se-ra' col='6'><li value='' range='0'>0</li><li value='p-1' range='1'>1</li><li value='p-2' range='2'>2</li><li value='p-3' range='3'>3</li><li value='p-4' range='4'>4</li><li value='p-5' range='5'>5</li></ul></div><hr>");
			  	break;
			  case "image_shadow":
			    $("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding schaduw</p><ul class='se se-ic' col='4'><li value=''>Off</li><li value='box-shadow-shallow'>SM</span></li><li value='box-shadow-realistic'>MD</span></li><li value='box-shadow-wide'>LG</li></ul></div><hr>");
			    break;
			  case "image_format":
			    $("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding formaat</p><ul class='se se-ic' col='4'><li value=''>Normal</li><li value='img-landscape'>Landscape</li><li value='img-square'>Vierkant</span></li><li value='img-portrait'>Portrait</span></li></ul></div><hr>");
			    break;
			  case "image_width":
			    $("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding Breedte</p><input class='range' type='range' min='0' max='8' value='0' title='Afbeelding Hoogte'><ul class='se-ra' col='9'><li value='width-auto' range='0'>Auto</li><li value='width-30' range='1'></li><li value='width-40' range='2'></li><li value='width-50' range='3'></li><li value='width-60' range='4'></li><li value='width-70' range='5'></li><li value='width-80' range='6'></li><li value='width-90' range='7'></li><li value='width-100' range='8'>100%</li></ul></div><hr>");
			    break;
			  case "image_grayscale":
			  	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.img'><p>Afbeelding grijswaarde</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='filter-grey'></li></ul></div><hr>");
			  	break;
			  case "element_border_radius":
			  	$("div[data-category='misc']").append("<div class='se-edit-item' type='class' element='.e'><p>Element afronding</p><input class='range' type='range' min='0' max='8' value='0' title='Overlay Helderheid'><ul class='se-ra' col='9'><li value='' range='0'>Off</li><li value='border-radius-4' range='1'>4</li><li value='border-radius-6' range='2'>6</li><li value='border-radius-8' range='3'>8</li><li value='border-radius-10' range='4'>10</li><li value='border-radius-15' range='5'>15</li><li value='border-radius-25' range='6'>25</li><li value='border-radius-50' range='7'>50</li><li value='border-radius-150' range='8'>150</li></ul></div><hr>");
			  	break;
			  case "item_columns":
			    $("div[data-category='layout']").append("<div class='se-edit-item se-edit-reload' type='class' element='.item'><p>Aantal kolommen</p><input class='range' type='range' min='0' max='3' value='0' title='Aantal kolommen'><ul class='se-ra' col='4'><li value='col-12' range='0'>1</li><li value='col-md-6' range='1'>2</li><li value='col-md-4' range='2'>3</li><li value='col-md-3' range='3'>4</li></ul></div><hr>");
			    break;
			  case "masonry":
			    $("div[data-category='layout']").append("<div class='se-edit-item se-edit-reload' type='class' element='.row-masonry'><p>Masonry</p><ul class='se se-ic' col='2'><li value=''>Uit</li></li><li value='masonry__container masonry--active'>Aan</li></ul></div><hr>");
			    break;
			  case "item_hover":				  
				  $("div[data-category='items']").append("<div class='se-edit-item' type='class' element='.item' element='item_hover'><p>Hover effect</p><select class='select'><option value='' disabled selected>Selecteer een effect</option><option value='item-hover-1'>Effect 1</option><option value='item-hover-2'>Effect 2</option><option value='item-hover-3'>Effect 3</option><option value='item-hover-4'>Effect 4</option></select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "menu_select":
				  var items = JSON.parse($('meta[name="menus"]').attr('content'));
				  
				  var options = "";
				  var optionsLi = "";
				  //options += "<option value=''>Geen items</option>";
				  $.each(items, function(index, element) {
					  options += "<option value='"+index+"'>"+element+"</option>";
					  optionsLi += "<li value='"+index+"'>"+element+"</li>";
				  });
				  
				  $("div[data-category='menu']").append("<div class='se-edit-item se-edit-reload' type='extra' element='menu_id'><p>Menu</p><select class='select'><option value='' disabled selected>Selecteer een menu</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "submenu_select":
				  var items = JSON.parse($('meta[name="menus"]').attr('content'));
				  
				  var options = "";
				  var optionsLi = "";
				  //options += "<option value=''>Geen items</option>";
				  $.each(items, function(index, element) {
					  options += "<option value='"+index+"'>"+element+"</option>";
					  optionsLi += "<li value='"+index+"'>"+element+"</li>";
				  });
				  
				  $("div[data-category='menu']").append("<div class='se-edit-item se-edit-reload' type='extra' element='submenu_id'><p>Submenu</p><select class='select'><option value='' disabled selected>Selecteer een menu</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "credmenu_select":
				  var items = JSON.parse($('meta[name="menus"]').attr('content'));
				  
				  var options = "";
				  var optionsLi = "";
				  //options += "<option value=''>Geen items</option>";
				  $.each(items, function(index, element) {
					  options += "<option value='"+index+"'>"+element+"</option>";
					  optionsLi += "<li value='"+index+"'>"+element+"</li>";
				  });
				  
				  $("div[data-category='menu']").append("<div class='se-edit-item se-edit-reload' type='extra' element='credmenu_id'><p>Credential Menu</p><select class='select'><option value='' disabled selected>Selecteer een menu</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "maps_marker":
			    $("div[data-category='maps']").append("<div class='se-edit-item se-edit-reload' type='attribute' attribute='data-marker-image' element='.e'><p>Map Marker</p><ul class='se se-ic' col='3'><li value='/public/images/marker/standard.png'>Standard</li><li value='/public/images/marker/light.png'>Light</li><li value='/public/images/marker/dark.png'>Dark</span></li></ul></div><hr>");
			    break;
			  case "maps_zoom":
			  	$("div[data-category='maps']").append("<div class='se-edit-item' type='attribute' attribute='data-map-zoom' element='.e'><p>Map Zoom</p><input class='range' type='range' min='0' max='9' value='8' title='Map Zoom'><ul class='se-ra' col='10'><li value='1' range='0'>1</li><li value='3' range='1'>3</li><li value='5' range='2'>5</li><li value='7' range='3'>7</li><li value='9' range='4'>9</li><li value='11' range='5'>11</li><li value='13' range='6'>13</li><li value='14' range='7'>14</li><li value='15' range='8'>15</li><li value='16' range='9'>16</li></ul></div><hr>");
			  	break;
			  case "maps_style":
				  $("div[data-category='maps']").append("<div class='se-edit-item se-edit-reload' type='extra' element='map_style_key'><p>Map Stijl</p><select class='select'><option value='' disabled selected>Selecteer een stijl</option><option value='maps.maps_styles.standard'>Standaard</option><option value='maps.maps_styles.silver'>Silver</option><option value='maps.maps_styles.dark'>Dark</option><option value='maps.maps_styles.retro'>Retro</option><option value='maps.maps_styles.night'>Night</option><option value='maps.maps_styles.aubergine'>Aubergine</option></select><li class='hidden active'></li></div></div><hr>");
				break;  
			  case "footer_column_content":
				  var options = "<option value='about-us'>Over ons</option><option value='company-info'>Bedrijfsinfo</option><option value='opening-hours'>Openingsuren</option><option value='menu'>Menu</option><option value='submenu'>Submenu</option><option value='map-iframe'>Maps Iframe</option><option value='map-api'>Maps API</option><option value='fb-feed'>Facebook feed</option>";
				  
				  $("div[data-category='footer']").append("<div class='se-edit-item se-edit-reload' type='extra' element='footer_column_"+fCC+"'><p>Footer kolom "+fCC+"</p><select class='select'><option value='' disabled selected>Selecteer een element</option>"+options+"</select><li class='hidden active'></li></div></div><hr>");
				  fCC++;
			    break;
			  case "divider_shape_top":
				  $("div[data-category='dividers']").append("<div class='se-edit-item se-edit-reload' type='extra' element='divider_shape_top'><p>Vorm divider Top</p><select class='select'><option value='' disabled selected>Selecteer een vorm</option><option value='waves'>Waves</option><option value='waves_opacity'>Waves opacity</option><option value='curve'>Curve</option><option value='curve_asymmetrical'>Curve asymmetrical</option><option value='triangle'>Triangle</option><option value='triangle_asymmetrical'>Triangle asymmetrical</option><option value='tilt'>Tilt</option><option value='arrow'>Arrow</option><option value='split'>Split</option><option value='book'>Book</option></select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "divider_color_top":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-top'><p>Divider kleur top</p><ul class='se se-co' col='4'><li value=''><span class=''></span></li><li value='divider--secondary'><span class='bg--secondary'></span></li><li value='divider--dark'><span class='bg--dark'></span></li><li value='divider--primary'><span class='bg--primary'></span></li></ul></div><hr>");
			  	break;
			  case "divider_flip_top":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-top'><p>Flip divider Top</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='divider-flipped'></li></ul></div><hr>");
			  	break;
			  case "divider_height_top":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-top'><p>Divider hoogte Top</p><input class='range' type='range' min='0' max='9' value='9' title='Divider Height'><ul class='se-ra' col='10'><li value='height-10-px' range='0'>10</li><li value='height-20-px' range='1'></li><li value='height-30-px' range='2'></li><li value='height-40-px' range='3'></li><li value='height-50-px' range='4'>50</li><li value='height-60-px' range='5'></li><li value='height-70-px' range='6'></li><li value='height-80-px' range='7'></li><li value='height-90-px' range='8'></li><li value='height-100-px' range='9'>100</li></ul></div><hr>");
			  	break;
			  case "divider_width_top":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-top'><p>Divider breedte Top</p><input class='range' type='range' min='0' max='4' value='0' title='Divider Width'><ul class='se-ra' col='5'><li value='width-100' range='0'>100</li><li value='width-150' range='1'></li><li value='width-200' range='2'></li><li value='width-250' range='3'></li><li value='width-300' range='4'>300</li></ul></div><hr>");
			  	break;
			  case "divider_shape_bottom":
				  $("div[data-category='dividers']").append("<div class='se-edit-item se-edit-reload' type='extra' element='divider_shape_bottom'><p>Vorm divider bottom</p><select class='select'><option value='' disabled selected>Selecteer een vorm</option><option value='waves'>Waves</option><option value='waves_opacity'>Waves opacity</option><option value='curve'>Curve</option><option value='curve_asymmetrical'>Curve asymmetrical</option><option value='triangle'>Triangle</option><option value='triangle_asymmetrical'>Triangle asymmetrical</option><option value='tilt'>Tilt</option><option value='arrow'>Arrow</option><option value='split'>Split</option><option value='book'>Book</option></select><li class='hidden active'></li></div></div><hr>");
			    break;
			  case "divider_color_bottom":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-bottom'><p>Divider kleur bottom</p><ul class='se se-co' col='4'><li value=''><span class=''></span></li><li value='divider--secondary'><span class='bg--secondary'></span></li><li value='divider--dark'><span class='bg--dark'></span></li><li value='divider--primary'><span class='bg--primary'></span></li></ul></div><hr>");
			  	break;
			  case "divider_flip_bottom":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-bottom'><p>Flip divider bottom</p><div class='se se-sw'><div class='switch'><div></div></div> <ul><li value=''></li><li value='divider-flipped'></li></ul></div><hr>");
			  	break;
			  case "divider_height_bottom":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-bottom'><p>Divider hoogte bottom</p><input class='range' type='range' min='0' max='9' value='9' title='Divider Height'><ul class='se-ra' col='10'><li value='height-10-px' range='0'>10</li><li value='height-20-px' range='1'></li><li value='height-30-px' range='2'></li><li value='height-40-px' range='3'></li><li value='height-50-px' range='4'>50</li><li value='height-60-px' range='5'></li><li value='height-70-px' range='6'></li><li value='height-80-px' range='7'></li><li value='height-90-px' range='8'></li><li value='height-100-px' range='9'>100</li></ul></div><hr>");
			  	break;
			  case "divider_width_bottom":
			  	$("div[data-category='dividers']").append("<div class='se-edit-item' type='class' element='.divider-bottom'><p>Divider breedte bottom</p><input class='range' type='range' min='0' max='4' value='0' title='Divider Width'><ul class='se-ra' col='5'><li value='width-100' range='0'>100</li><li value='width-150' range='1'></li><li value='width-200' range='2'></li><li value='width-250' range='3'></li><li value='width-300' range='4'>300</li></ul></div><hr>");
			  	break;
			} 
		});
		
		$(".se-edit-category").each(function(index){
			if($(this).find('div').text().length == 0){
				$(this).remove();
			}
		});
		
		//check permission to edit item settings otherwise remove
		if($('meta[name="layout_editor_items"]').attr('content') !== "1"){
			$("div[data-category='items']").closest('.se-edit-category').css("display","none");
		}
		
		//remove btn
		$(".se-edit-items").append("<a href='#' id='open-pop-up' class='btn btn--rounded btn-remove'>Sectie verwijderen</a>");
		$(".se-edit-items").append("<div id='se-edit-overlay'><div id='se-edit-pop-up'><h3>Sectie verwijderen</h3><p>Bent u zeker dat u deze sectie wilt verwijderen? Bij het verwijderen gaan alle wijzigingen verloren.</p><a href='#' id='remove-section' class='btn btn--rounded btn-remove'>Verwijderen</a><a href='#' id='cancel-pop-up' class='btn btn--rounded btn-close'>Annuleren</a></div></div>");
		
		sectionBuilder({
			check:true
		});
	});
	
	//OPEN CATEGORY
	$(document).on('click', '.se-edit-category p', function () {
		$(this).closest('.se-edit-category').toggleClass('active');
	});
	
	//DETECT ITEM ID CHANGE TO CHANGE INPUT OPTIONS
	$(document).on('change', '.se-edit-item[element="item_id"] select', function () {
		$(".item-input-select optgroup").css('display','none');
		var elem = $(this);
		
		//with small delay to ensure we get the right amount
		setTimeout(function(){
			var val = elem.find('option[selected="selected"]').text();
			
			$(".item-input-select").each(function(index){
				$(this).find("optgroup[label='"+val+"']").css('display','block');
			});
		}, 10);
		
	});
	
	//CLICK EDIT
	$(document).on('click', '.se-edit-item li', function () {
		$(this).closest("ul").find(".active").removeClass("active");
		$(this).closest(".se-edit-item").addClass('edited');
		$(this).addClass("active");
		
		sectionBuilder({
			construct:true
		});
	});
	
	//RANGE EDIT
	function getRangeValue(){
		$(".range").each(function(index){
			var val = $(this).val();
			
			$(this).parent().find(".active").removeClass("active");
			$(this).parent().find("li[range='"+val+"']").addClass("active");
		});
	};
	
	getRangeValue();
	
	$(document).on('change', '.range', function () {
		$(this).closest(".se-edit-item").addClass('edited');
		getRangeValue();
		sectionBuilder({
			construct:true
		});
	});
	
	//SWITCH EDIT
	$(document).on('click', '.switch', function () {
		$(this).closest(".se-edit-item").addClass('edited');
		$(this).toggleClass("active");
		
		if($(this).hasClass('active')){
			$(this).parent().find("li:first-child").removeClass("active");
			$(this).parent().find("li:last-child").addClass("active");
		}else{
			$(this).parent().find("li:first-child").addClass("active");
			$(this).parent().find("li:last-child").removeClass("active");
		}
		
		sectionBuilder({
			construct:true
		});
	
	});
	
	//SELECT EDIT
	$(document).on('change', '.select', function () {
		$(this).closest("div").addClass('edited');
		var value = $(this).val();
		$(this).closest("div").find('li').attr('value',value);
		
		sectionBuilder({
			construct:true
		});
	
	});
	
	$(document).on('keyup', '.input', function () {
		var value = $(this).val();
		$(this).closest("div").find('li').attr('value',value);
		
		sectionBuilder({
			construct:true
		});
	});
	
	//CLOSE SIDE MENU
	$(document).on('click', ".se-close, .se-overlay", function () {
		//Only save the active edit menu and add loader for images (only visual has no function)
		if($('.se-edit-menu').hasClass('active') == true){
// 			$(".se-edit-menu").removeClass("active");
		    
		    sectionBuilder({
				construct:true,
				save:true
			});

			if($('.se-edit-reload.edited').length > 0){
			  	ReloadSection();
		  	}else{
			  	loadScripts();
		  	}
		}
		
		if($('#se-edit-images').hasClass('active') == true){
			$("#se-edit-images").removeClass("active");
		    
		    if($("#se-edit-images").hasClass('edited')){
			    parseResponse(1,"De afbeeldingen zijn opgeslagen!");
				ReloadSection();
		    }
		}
		
		closeAll();
	});
	
	/*
	|
	|	4. CONTENT EDITOR 
	|
	*/
	
	function delay(callback, ms) {
		var timer = 0;
		return function() {
			//only works when autosave is on
			if($('meta[name="autosave"]').length !== 0){
				var context = this, args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function () {
					callback.apply(context, args);
				}, ms || 0);
			}
		};
	}
	
	//UNDO EXECUTE
	$(document).on('click', '.undo', function () {
		document.execCommand('undo', false, null);
	});
	
	$(document).on('click', '.redo', function () {
		document.execCommand('redo', false, null);
	});
	
	//register that a field is edited
	$(document).on('DOMSubtreeModified', 'data[contenteditable="true"]', function (e) {
		$(this).addClass("edited");
		$(this).attr("data-empty",0);
		$(".control-bar span").html("<i class='ti-alert'></i>Uw wijzigingen zijn niet opgeslagen");
		$(".control-bar .btn").addClass("active");
		
		$(this).find('p').contents().unwrap();

		if($('meta[name="autosave"]').length !== 0){
			$(".spinner").addClass("active");
		}
	});
	
	$(document).on('DOMSubtreeModified', 'data[contenteditable="true"]', delay(function (e) {
		saveContent();
	}, 5000));
	
	$(document).on('click', '#save-content', function (event) {
		saveContent();
		event.preventDefault();
	});
	
	$(document).on('click', '.se-status', function () {
		toggleStatus($(this));
	});
	
	//image edit
	$(document).on('click', '.bg-img-edit, img[contenteditable="true"], div[src]', function (event) {
		//$(this).empty();
		
		var id = $(this).attr("data-id");
		var sectionId = $(this).closest("section.adjustable").attr("data-id");
		
		//sets the section id so the section reload function can happen
		$(".se-edit-menu").attr("data-id",sectionId);
		
		//location.reload();
		
		var module = $(this).attr("data-module");
	
		if (typeof module !== typeof undefined && module !== false) {
		  // Element has this attribute and therefore is a item elment
		  	var url = "/admin/items/"+module+"/"+id+"/edit/item form";
		}else{
			var url = "/admin/content/"+id+"/edit/content form";
		}
		
		$("#se-edit-images").load(url, function(responseText, textStatus, XMLHttpRequest){
			
			dropzoneInit();
			
			$("#se-edit-images").prepend("<div class='se-close'><i class='stack-left-open-big'></i><p>Sluit</p></div>");
		    $("#se-edit-images").addClass("active");
	        $(".se-overlay").addClass("active");
	        
	        $("#se-edit-images .col-sm-4").remove();
			$("#se-edit-images .col-sm-8").removeClass("col-sm-8").addClass("col-sm-12");
			$(".form-group:not(.dropzone-input)").remove();
		    
	/*
		    jQuery.ajax({
		        url: "/public/js/dropzone.js",
		        dataType: 'script',
		        async: true,
		        success: function(response) {
			        $("#se-edit-images").addClass("active");
			        $(".se-overlay").addClass("active");
			        
			        $("#se-edit-images .col-sm-4").remove();
					$("#se-edit-images .col-sm-8").removeClass("col-sm-8").addClass("col-sm-12");
					$(".form-group:not(.dropzone-input)").remove();
					
		        }
		    });
	*/
			
		});
		event.preventDefault();
	});
	
	// target element that we will observe
	const target = document.getElementById('se-edit-images');
	
	// config object
	const config = {
	  attributes: true,
	  attributeOldValue: true,
	  characterData: true,
	  characterDataOldValue: true,
	  childList: true,
	  subtree: true
	};
	
	// subscriber function
	function dropzoneCheck(mutations) {
	  mutations.forEach((mutation) => {
	    // handle mutations here
	    if(mutation["target"]['className'] == "dz-overlay"){
		    //console.log(mutation["target"]['className']);
		    $("#se-edit-images").addClass("edited");
	    }
	  });
	}
	
	// instantiating observer
	const observer = new MutationObserver(dropzoneCheck);
	
	// observing target
	observer.observe(target, config);
	
	//btn / link edit
	$('a[href="#"], .editable-link').click( function(e) {
		e.preventDefault();
	});
	
	$(document).on('click', '.editable-link-edit', function () {
		$(this).parent().find('.editable-link-input').toggleClass('active');
	});
	
	$(document).on('click', '.editable-link-edit-close', function () {
		$(this).parent().toggleClass('active');
	});
	
	$(document).on('keyup', '.editable-link-input data', function () {
		var link = $(this).text();
		$(this).closest('.editable-link-menu').find('.editable-link-goto').attr('data-link',link);
	});
	
	$(document).on('click', '.editable-link-goto', function () {
		var link = $(this).attr('data-link');
		
		if(link !== undefined && link !== "#"){
			window.location.href = link;
		}
	});
	
	//MENU ORDERER
	$("nav ul").sortable({
	    items:'li',
	    cursor: 'move',
	    opacity: 0.5,
	    containment: 'ul',
	    distance: 50,
	    tolerance: 'pointer',
	    placeholder: 'marker',
	    animation: 200,
	    update: function(e, ui){
	        //order the menu items
	    }
	}); //.disableSelection()
	
	$(document).on('click', '#open-pop-up', function (event) {
		$('#se-edit-overlay').addClass('active');
		$('#se-edit-pop-up').addClass('active');
		event.preventDefault();
	});
	
	$(document).on('click', '#remove-section', function (event) {
		$('#se-edit-overlay').removeClass('active');
		$('#se-edit-pop-up').removeClass('active');
		
		var id = $(".se-edit-menu").attr("data-id");
		
		jQuery.ajax({
	        url: '/admin/content/'+id+'/destroy/section',
	        dataType: 'script',
	        type: 'DELETE',
	        headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		    },
	        success: function(response) {
		        $('#se-edit-overlay').removeClass('active');
				$('#se-edit-pop-up').removeClass('active');
				$(".adjustable[data-id='"+id+"']").remove();
				closeAll();
	        }
	    });
		
		event.preventDefault();
	});
	
	$(document).on('click', '#cancel-pop-up', function (event) {
		$('#se-edit-overlay').removeClass('active');
		$('#se-edit-pop-up').removeClass('active');
		event.preventDefault();
	});
	
	/*
	|
	|	5. SECTION EDITOR 
	|
	*/
	
	$(".manageable").append("<div class='se-add add-btn se-add-top'><i class='fa fa-plus'></i></div>");
	$(".manageable").append("<div class='se-add add-btn se-add-bottom'><i class='fa fa-plus'></i></div>");
	
	//Shows the add component btn
	$(document).on('mousemove', '.manageable', function (e) {
		if($(".manageable:hover").length != 0){
			//makes sure the dynamicly added .se-add buttons have the correct data-type
			switch(true) {
			  case $(this).parent().is("header"):
			    $(this).find(".se-add").attr("data-type",1);
			    break;
			  case $(this).parent().is("main"):
			    $(this).find(".se-add").attr("data-type",2);
			    break;
			  case $(this).parent().is("footer"):
			    $(this).find(".se-add").attr("data-type",3);
			    break;
			}
			
			var h = $(this).outerHeight(); //height element
		    var y = e.pageY - this.offsetTop; //height mouse
		    
		    if(h > 200){
			    var hP = h * 0.8; //80% of height element if element is larger then 200px
		    }else{
			    var hP = h * 0.7; //60% of height element if element is smaller then 200px
		    }
			
			$(this).find(".se-add-top").addClass("active");
			$(this).find(".se-add-bottom").addClass("active");
			
/*
			if(h - hP > y){
				$('.se-add-btn').removeClass("active");
				$(this).find(".se-add-top").addClass("active");
			}else{
				$(this).find(".se-add-top").removeClass("active");
			}
			
			if(hP < y){
				$('.se-add-btn').removeClass("active");
				$(this).find(".se-add-bottom").addClass("active");
			}else{
				$(this).find(".se-add-bottom").removeClass("active");
			}
*/
		}else{
			$(this).find(".se-add-top").removeClass("active");
			$(this).find(".se-add-bottom").removeClass("active");
		}
	});
	
	$(document).on('click', '.se-add', function () {
		var elem = $(this);
		$(".se-add").removeClass('active');
		var type = elem.attr('data-type');
		
		//Parses the placholder
		var placeholder = "<section class='manageable-placeholder remove'><i class='fa fa-plus'></i><p>Sleep en plaats je nieuwe sectie hier!</p></section>";
		
		switch(true) {
		  case elem.hasClass("se-add-top"):
		  	$(placeholder).insertBefore(elem.closest(".manageable"));
		    break;
		  case elem.hasClass("se-add-bottom"):
		  	$(placeholder).insertAfter(elem.closest(".manageable"));
		    break;
		}
		
		//Animate section placeholder
		setTimeout(function(){
			if(elem.hasClass("manageable-placeholder")){
				//using the placholder sections
				elem.addClass("active");
			}else{
				//using the between section buttons
				elem.parent().parent().find(".manageable-placeholder").addClass("active");
			}
			
			//Sets the section type
			switch(true) {
			  case $(".manageable-placeholder.active").parent().is("header"):
			    $(".manageable-placeholder.active").attr("data-type",1);
			    break;
			  case $(".manageable-placeholder.active").parent().is("main"):
			    $(".manageable-placeholder.active").attr("data-type",2);
			    break;
			  case $(".manageable-placeholder.active").parent().is("footer"):
			    $(".manageable-placeholder.active").attr("data-type",3);
			    break;
			}
		}, 20);
		
		//make existing sections transparent
		$(".manageable").addClass("transparant");
		
		//loads the correct sections per type
		$(".se-section-list").load("/admin/content/load/section/"+type+"/list", function(responseText, textStatus, XMLHttpRequest){
			loadBlazy();
			
			$(".se-section-list").toggleClass("active");
			$(".se-overlay").addClass("active");
			//$(".se-section-list-main").sortable("refresh");
			
			$(".se-section-list-main").scroll( function () {
			    $(".se-section-list-main").attr("scrolled", $(".se-section-list-main").scrollTop());
			});
			
			setTimeout(function(){
				$(".section-thumbnail").draggable({
				    revert: true,
				    scroll: false,
				    start: function( event, ui ) {
					    //fixes the scroll problem when only using css overflow to regulate this
						$(".se-section-list-main").removeClass("scroll");
						$(".se-section-list-main").css("top", "-"+$(".se-section-list-main").attr("scrolled")+"px");
					},
					stop: function( event, ui ) {
						$(".se-section-list-main").addClass("scroll");
						$(".se-section-list-main").css("top", "0");
					}
				});
				
				$(".manageable-placeholder.active").droppable({
					hoverClass: "hover",
					drop: function( event, ui ) {
						
						var placeholder = $(this);
						placeholder.addClass("remove");
						
						//prevents the page id set on header and footer type sections
						if(placeholder.attr("data-type") !== "2"){
							var page = 0;
						}else{
							var page = $('meta[name="page"]').attr('content');
						}

						//give correct position
						var position = 1;
						var list = new Array();
						$('.manageable-placeholder').parent().find("section").each(function() {
							if($(this).hasClass('remove')){
								var listItem =[{
									id:0,
									position:position,
								}];
							}else{
								var listItem =[{
									id:$(this).attr("data-id"),
									position:position,
								}];
							}
							list.push(listItem)
							position++;
						});

						var dataArray = {
							id: ui.draggable.attr("data-id"),
							type: placeholder.attr("data-type"),
							page: page,
							name: ui.draggable.attr("data-name"),
							list: JSON.stringify(list)
						};
console.log(dataArray);
						$.ajax({
						   url: "/admin/content/insert/section",
						   data: dataArray,
						   type: 'POST',
						   headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						   success: function(r) {
							   //adds an element that will be used to correctly place the new section
							   $("<progress></progress>").insertAfter(placeholder);
							   
							   var currentUrl = window.location.pathname;
							   $("progress").load(currentUrl + " .manageable[data-id='"+r+"']", function () {
								   //removes the temporary <progress> wrapper
								   var e = $(".manageable[data-id='"+r+"']");
								   e.unwrap();
								   
								   //adds all the editable elements of the new section to the editor
								   editor.addElements('data[contenteditable="true"]');
								   
								   //adds the se-edit button if option is available
									var id = e.attr("data-id");
									var section = e.attr("data-section");
									var editable = e.attr("data-editable");
									$(".manageable[data-id='"+r+"'].adjustable").append("<div class='se-edit' data-id='"+id+"' data-section='"+section+"' data-editable='"+editable+"'><i class='stack-cog'></i></div>");
									$(".manageable[data-id='"+r+"']").append("<div class='se-add add-btn se-add-top'><i class='fa fa-plus'></i></div>");
									$(".manageable[data-id='"+r+"']").append("<div class='se-add add-btn se-add-bottom'><i class='fa fa-plus'></i></div>");
									
									//automaticlly removes the overlay after adding an item
									$(".se-overlay").removeClass("active");
									$(".se-section-list").removeClass("active");
									$(".manageable").removeClass("transparant");
									$(".manageable-placeholder.remove").remove();
									
								   loadScripts();
							   });
						   }
						});
					}
			    });
			}, 10);
			
		});
	
	});
	
	$(document).on('click', '.tag', function () {
		$(this).toggleClass("active");
		$(".section-thumbnail").removeClass('active');
		
		$(".tag.active").each(function(index){
			var tag = $(this).attr("data-search");
			$(".section-thumbnail[data-tags~='"+tag+"']").addClass("active");
		});
		
		if($(".tag.active").length == 0){
			$(".section-thumbnail").addClass("active");
		}
	});
	
	/*
	$(document).on('wheel', '.se-section-list-main', function (e) {
		if (e.originalEvent.deltaY < 0) {
	    	$(this).scrollTop(0, -1);
	    } else {
	    	$(this).scrollTop(0, 1);
	    }
	});
	*/
});