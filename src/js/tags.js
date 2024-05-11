(function(){
    const tagsInput = document.querySelector('#tags_input');
    if(tagsInput) {
        
        // Input hidden
        const tagsInputHidden = document.querySelector('[name="tags"]');
        // Contenedor de etiquetas
        const contenedorTags = document.querySelector('.formulario__listado');
        // Arreglo de etiquetas
        let tags = [];
        // Escuchar cambios en el input
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            if(e.keyCode === 44) {
                e.preventDefault();
                const tagName = e.target.value.trim();
                if(tagName === '' || tagName.length <= 1 || tags.map(tag=>tag.toLowerCase()).includes(tagName.toLowerCase())) {
                    tagsInput.value = '';
                    return;
                }
                tags = [...tags, tagName];
                tagsInput.value = '';

                mostrarTags();
            }
        }

        function mostrarTags() {
            contenedorTags.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;

                contenedorTags.appendChild(etiqueta);
            })

            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            tagsInputHidden.value = tags.toString();
        }

        function eliminarTag(e) {
            tags = tags.filter(tag => tag !== e.target.textContent);
            e.target.remove();
            actualizarInputHidden();
        }
    }
})()
