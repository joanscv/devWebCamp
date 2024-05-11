<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input type="text" 
               name="nombre" 
               id="nombre"
               class="formulario__input" 
               placeholder="Nombre Ponente" 
               value="<?php echo $ponente->nombre ?? '';?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input type="text" 
               name="apellido" 
               id="apellido"
               class="formulario__input"  
               placeholder="Apellido Ponente" 
               value="<?php echo $ponente->apellido ?? '';?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input type="text" 
               name="ciudad" 
               id="ciudad"
               class="formulario__input"  
               placeholder="Ciudad Ponente" 
               value="<?php echo $ponente->ciudad ?? '';?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="pais">País</label>
        <input type="text" 
               name="pais" 
               id="pais"
               class="formulario__input"  
               placeholder="País Ponente" 
               value="<?php echo $ponente->ciudad ?? '';?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input type="file" 
               name="imagen" 
               id="imagen" >
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experiencia (separadas por coma)</label>
        <input type="text" 
               id="tags_input"
               class="formulario__input"  
               placeholder="Ej. Node.js, PHP, CSS, Laravel, UX/UI">
    </div>
    <ul class="formulario__listado"></ul>
    <input type="hidden" name="tags" value="<? echo $ponente->tags ?? ''; ?>">

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-linkedin"></i>
            </div>
            <input type="text" 
               name="redes[linkedin]" 
               class="formulario__input--sociales"  
               placeholder="LinkedIn" 
               value="<?php echo $ponente->redes['linkedin'] ?? '';?>">
        </div>  
    </div>
    
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" 
               name="redes[facebook]" 
               class="formulario__input--sociales"  
               placeholder="Facebook" 
               value="<?php echo $ponente->redes['facebook']?? '';?>">
        </div>  
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-x-twitter"></i>
            </div>
            <input type="text" 
               name="redes[twitter-x]" 
               class="formulario__input--sociales"  
               placeholder="Twitter (ahora X)" 
               value="<?php echo $ponente->redes['twitter']?? '';?>">
        </div>  
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text" 
               name="redes[youtube]" 
               class="formulario__input--sociales"  
               placeholder="Youtube" 
               value="<?php echo $ponente->redes['youtube']?? '';?>">
        </div>  
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text" 
               name="redes[instagram]" 
               class="formulario__input--sociales"  
               placeholder="Instagram" 
               value="<?php echo $ponente->redes['instagram']?? '';?>">
        </div>  
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text" 
               name="redes[tiktok]" 
               class="formulario__input--sociales"  
               placeholder="TikTok" 
               value="<?php echo $ponente->redes['tiktok']?? '';?>">
        </div>  
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text" 
               name="redes[github]" 
               class="formulario__input--sociales"  
               placeholder="GitHub" 
               value="<?php echo $ponente->redes['github']?? '';?>">
        </div>  
    </div>
</fieldset>