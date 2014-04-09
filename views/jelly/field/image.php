<?php
	echo Form::file($name, $attributes + array('id' => 'field-'.$name));

	// If there is an uploaded image then display it.
	// If there are thumbnails then display those instead.
	if ($value != '' && !is_array($model->{$field->name})) {

		echo '<ul class="imagefiles">';
		if (count($field->thumbnails)) {
			for ($i = count($field->thumbnails); $i--; $i > -1) {
				$thumbnail = $field->thumbnails[$i];

                // Handle suffixes

                if ($thumbnail['suffix']){

                    $parts = explode('.',$model->{$field->name});
                    $parts[count($parts)-2] .= $thumbnail['suffix'];
                    $name = implode('.',$parts);

                }else{

                    $name = $model->{$field->name};
                }

				if (!isset($thumbnail['hide_in_admin_list'])) {
					echo '<li>';
					echo Html::image($field->get_web_path($thumbnail['path'], $i) . $name);
					echo '</li>';
				}
			}
		} else {
			echo '<li>';
			echo Html::image($field->get_web_path($field->path) . $model->{$field->name});
			echo '</li>';
		}
		echo '</ul>';
	}
?>