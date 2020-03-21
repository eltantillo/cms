<br/><br/>
<div class="row">
	<form method="POST" class="form col s12" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">title</i>
				<input name="title" id="title" type="text" value="<?php if($edit){echo $post['title'];} ?>" autofocus>
				<label for="title">Titulo</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">attach_money</i>
				<input name="price" id="price" type="text" value="<?php if($edit){echo $post['price'];} ?>">
				<label for="price">Precio</label>
			</div>
			
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">content_copy</i>
				<input name="pages" id="pages" type="text" value="<?php if($edit){echo $post['pages'];} ?>">
				<label for="pages">Numero de paginas</label>
			</div>
			
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">access_time</i>
				<input name="duration" id="duration" type="text" value="<?php if($edit){echo $post['duration'];} ?>">
				<label for="duration">Duracion</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">school</i>
				<select name="grades[]" id="grades" multiple>
					<?php
						$post['grades'] = explode(',', $post['grades']);
						foreach($GRADES as $grade => $string){
							$selected = '';
							if ($edit and in_array($grade, $post['grades']) !== false){
								$selected = 'selected';
							}
							echo '<option value="' . $grade . '" ' . $selected . '>' . $string . '</option>';
						}
					?>
				</select>
				<label>Grado</label>
			</div>
			
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">import_contacts</i>
				<select name="subjects[]" id="subjects" multiple>
					<?php
						$post['subjects'] = explode(',', $post['subjects']);
						foreach($SUBJECTS as $subject => $string){
							$selected = '';
							if ($edit and in_array($subject, $post['subjects']) !== false){
								$selected = 'selected';
							}
							echo '<option value="' . $subject . '" ' . $selected . '>' . $string . '</option>';
						}
					?>
				</select>
				<label>Materia</label>
			</div>
			
			<div class="input-field col s12 m4">
				<i class="material-icons prefix">inbox</i>
				<select name="types[]" id="types" multiple>
					<?php
						$post['types'] = explode(',', $post['types']);
						foreach($TYPES as $type => $string){
							$selected = '';
							if ($edit and in_array($type, $post['types']) !== false){
								$selected = 'selected';
							}
							echo '<option value="' . $type . '" ' . $selected . '>' . $string . '</option>';
						}
					?>
				</select>
				<label>Recursos</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea class="materialize-textarea" name="content" id="content"><?php if($edit){echo $post['content'];} ?></textarea>
				<label for="content">Descripcion</label>
				
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field col s12 m6">
				<div class="btn">
					<span>Recurso</span>
					<input type="file" name="resource" id="recource">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
			<div class="file-field input-field col s12 m6">
				<div class="btn">
					<span>Vista previa</span>
					<input type="file" name="preview" id="preview">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<button type="submit" class="btn">Enviar</button>
			</div>
		</div>
	</form>
</div>