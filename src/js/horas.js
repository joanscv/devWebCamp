(function () {
  const horas = document.querySelector(".horas");

  if (horas) {
    let busqueda = {
      categoria_id: "",
      dia: "",
    };

    const categoria = document.querySelector("[name='categoria_id'");
    const dias = document.querySelectorAll("[name='dia']");
    const inputHiddenDia = document.querySelector("[name='dia_id']");
    dias.forEach((dia) => dia.addEventListener("input", terminoBusqueda));
    categoria.addEventListener("input", terminoBusqueda);

    function terminoBusqueda(e) {
      busqueda[e.target.name] = e.target.value;
      console.log(busqueda);
    }
  }
})();
