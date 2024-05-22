<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información Evento</legend>
  <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre Evento</label>
        <input type="text" 
               name="nombre" 
               id="nombre"
               class="formulario__input" 
               placeholder="Nombre Evento">
  </div>
  <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripción</label>
        <textarea 
              class="formulario__input"
              name="descripcion" 
              id="descripcion" 
              placeholder="Descripción Evento"
              rows="8" ></textarea>
  </div>
  <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoría o Tipo de Evento</label>
        <select name="categoria_id" id="categoria" class="formulario__select">
          <option value="" disabled selected>- Seleccionar -</option>
          <?php foreach($categorias as $categoria):?>
            <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
          <?php endforeach; ?>
        </select>
  </div>

  <div class="formulario__campo">
        <label class="formulario__label" for="dia">Selecciona el día</label>
        <div class="formulario__radio">
            <?php foreach($dias as $dia): ?>
              <div>
                <label for="<?php echo strtolower($dia->nombre);?>"><?php echo $dia->nombre;?></label>
                <input 
                    type="radio" 
                    name="dia" 
                    id="<?php echo strtolower($dia->nombre);?>" 
                    value="<?php echo $dia->id;?>">
              </div>
            <?php endforeach; ?>
        </div>
  </div>

  <div id="horas" class="formulario__campo">
    <label class="formulario__label">Seleccionar Hora</label>
    <ul class="horas">
      <?php foreach($horas as $hora): ?>
        <li class="horas__hora"><?php echo $hora->hora; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información Extra</legend>
  <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Ponente</label>
        <input type="text" 
               id="ponentes"
               class="formulario__input" 
               placeholder="Buscar Ponente">
  </div>
  <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">Lugares Disponibles</label>
        <input type="number"
               min="1" 
               id="disponibles"
               name="disponibles"
               class="formulario__input" 
               placeholder="Ej. 20">
  </div>
</fieldset>