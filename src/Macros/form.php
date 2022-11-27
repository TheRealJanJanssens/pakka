<?php

Form::macro('myInput', function ($type = "text", $name, $label = "", $options = [], $default = null, $lang = null, $row = false, $prepend = false, $append = false) {
    $transIdInput = '';

    if (strpos($name, '[') !== false) {
        preg_match('~=[.*?)]~', $name, $output);
        if (isset($output[1])) {
            $nameArray = '['.$output[1].']';
        } else {
            $nameArray = '[]';
        }

        $nameTrans = substr($name, 0, strpos($name, "["));
    } else {
        $nameArray = '';
        $nameTrans = $name;
    }

    if (is_array($default)) {
        $defaultValue = $default[0];
        $defaultTransId = $default[1];
    } else {
        $defaultValue = $default;
        $defaultTransId = $default;
    }

    if ($lang !== null) {
        $transIdInput = Form::input("hidden", "translation_id[$nameTrans]$nameArray", $defaultTransId, array_merge(["class" => "form-control"]));
        $name = "$lang:$name";
    }

    $classGroup = "";
    $classInput = "";
    $classLabel = "";

    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    if ($prepend !== false) {
        $prepend = '<div class="input-group-prepend"><span class="input-group-text input-group-addon">'.$prepend.'</span></div>';
    }

    if ($append !== false) {
        $append = '<div class="input-group-append"><span class="input-group-text input-group-addon">'.$append.'</span></div>';
    }

    if ($prepend !== false || $append !== false) {
        $inputGroupStart = '<div class="input-group">';
        $inputGroupEnd = '</div>';
    } else {
        $inputGroupStart = '';
        $inputGroupEnd = '';
    }

    if ($type == "hidden") {
        return $label . Form::input($type, $name, $defaultValue, array_merge(["class" => "hidden"], $options)). " ".$transIdInput;
    } else {
        $attr = "";
        if ($lang !== null) {
            $attr = 'data-lang="'.$lang.'"';
        }

        return "
	        <div class='form-group ".$classGroup."' ".$attr.">
	            ". $label .
                $inputGroupStart
                . $prepend .
                  Form::input($type, $name, $defaultValue, array_merge(["class" => "form-control".$classInput], $options)). " ".$transIdInput.
                   $append .
                   $inputGroupEnd."
	        </div>
	    ";
    }
});

Form::macro('mySelect', function ($name, $label = "", $values = [], $selected = null, $options = [], $row = false, $btn = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "xs":
                $classInput = " col-sm-9";
                $classLabel = "col-sm-3 col-form-label";

                break;
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    if ($btn !== false) {
        return "
	        <div class='form-group".$classGroup."'>
	            ". $label .
                  Form::select($name, $values, $selected, array_merge(["id" => $btn, "class" => "form-control".$classInput], $options))."
	        </div>
	    ";
    } else {
        return "
	        <div class='form-group".$classGroup."'>
	            ". $label .
                  Form::select($name, $values, $selected, array_merge(["class" => "form-control".$classInput], $options))."
	        </div>
	    ";
    }
});

Form::macro('myFile', function ($name, $label = "", $options = [], $row = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    return "
        <div class='form-group".$classGroup."'>
            ". $label .
              Form::file($name, array_merge(["class" => "form-control-file"], $options)). "
        </div>
    ";
});

Form::macro('myTextArea', function ($name, $label = "", $options = [], $default = null, $lang = null, $row = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $transIdInput = '';
    if ($lang !== null) {
        $transIdInput = Form::input("hidden", "translation_id[$name]", $default, array_merge(["class" => "form-control"]));
        $name = "$lang:$name";
    }
    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    return "
        <div class='form-group".$classGroup."' data-lang='".$lang."'>
            ". $label .
              Form::textarea($name, $default, array_merge(["class" => "form-control".$classInput, "rows" => 3], $options)). " ".$transIdInput."
        </div>
    ";
});

Form::macro('myCheckbox', function ($name, $label = "", $value = '', $valueFalse = null, $checked = false, $options = [], $class = 'mB-15') {
    if ($valueFalse !== null) {
        $valueFalse = Form::input("hidden", $name, $valueFalse, []);
    }

    return "
        <div class='checkbox checkbox-circle checkbox-info peers ai-c ".$class."'>
            ".
                $valueFalse
            .
                Form::input("hidden", "translation_id[$name]", null, array_merge(["class" => "form-control input-translation-id"])).
                Form::checkbox($name, $value, $checked, ['id' => $name] + $options)."
            <label for='$name' class='peers peer-greed js-sb ai-c'>
                <span class='peer peer-greed'>$label</span>
            </label>
        </div>
    ";
});

Form::macro('myRadio', function ($name, $label = "", $value = '', $valueFalse = null, $checked = false, $options = [], $class = 'mB-15') {
    if ($valueFalse !== null) {
        $valueFalse = Form::input("hidden", $name, $valueFalse, []);
    }

    $id = $name.'-'.rand(100, 999);

    return "
        <div class='radio radio-circle radio-info peers ai-c ".$class."'>
            ".
                $valueFalse
            .
                Form::input("hidden", "translation_id[$name]", null, array_merge(["class" => "form-control input-translation-id"])).
                Form::radio($name, $value, $checked, ['id' => $id] + $options)."
            <label for='$id' class='peers peer-greed js-sb ai-c'>
                <span class='peer peer-greed'>$label</span>
            </label>
        </div>
    ";
});

Form::macro('myRange', function ($name, $start, $end, $selected = '', $options = [], $row = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    return "
        <div class='form-group".$classGroup."'>
            " . Form::selectRange($name, $start, $end, $selected, array_merge(["class" => "form-control".$classInput], $options)). "
        </div>
    ";
});

Form::macro('mySwitch', function ($name, $label = "", $value = null, $checked = false, $options = []) {
    return "
        <div class='form-group form-group-nm'>
            <label class='input-switch'>
			  ".
                Form::checkbox('', null, true, ['id' => $name] + $options)
              ."
			  <i></i>
			  <p>".$label."</p>
			</label>

			".Form::input("hidden", "translation_id[$name]", null, array_merge(["class" => "form-control input-translation-id"])).
            Form::input("hidden", $name, null, array_merge(["class" => "form-control"]))."
        </div>
    ";
});

/* Custom inputs for items module */

Form::macro('myItemsSelect', function ($name, $label = "", $values = [], $selected = null, $options = [], $row = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $results = [];
    $emptyValue = 0;
    if ($values) {
        foreach ($values as $value) {
            //detects empty value
            if (empty($value['option_id']) && empty($value['value'])) {
                $emptyValue = 1;

                continue;
            }

            $id = $value['option_id'];
            $results[$id] = $value['value'];
        }
    }

    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    return "
        <div class='form-group".$classGroup."'>
            ". $label .
              Form::select($name, $results, $selected, array_merge(["class" => "form-control".$classInput], $options)).
              Form::input("hidden", "translation_id[$name]", null, array_merge(["class" => "form-control input-translation-id"]))."
        </div>
    ";
});

Form::macro('myColorPicker', function ($name, $label = "", $default = null, $row = false) {
    $classGroup = "";
    $classInput = "";
    $classLabel = "";
    if ($row !== false) {
        $classGroup = " row";

        switch ($row) {
            case "s":
                $classInput = " col-sm-7";
                $classLabel = "col-sm-5 col-form-label";

                break;
            default:
                $classInput = " col-sm-10";
                $classLabel = "col-sm-2 col-form-label";

                break;
        }
    }

    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label, ['class' => $classLabel]));

    return "
        <div class='form-group".$classGroup."'>
            ". $label ."
            <div class='colorpick-input-btn ".$classInput."'><i class='ti-paint-bucket'></i></div>
            ".
              Form::input('hidden', $name, $default, array_merge(["class" => "form-control colorpick-input"]))."
        </div>
    ";
});

Form::macro('myPrice', function ($name, $label = "", $options = [], $default = null) {
    $label = ($label == '') ? '' : html_entity_decode(Form::label($name, $label));

    return "
        <div class='form-group'>
            ". $label ."
              <div class='input-group'>
              		<div class='input-group-prepend'>
						<span class='input-group-text input-group-addon'><i class='fas fa-euro-sign'></i></span>
					</div>

					".
                    Form::input('number', $name, $default, array_merge(["class" => "form-control","step" => "0.01"]))."
				</div>
        </div>
    ";
});
