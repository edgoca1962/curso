import Swal from "sweetalert2"

console.log('WP Framework theme')

if (document.getElementById('anuncio_foto')) {
   const anuncio_foto = document.getElementById('anuncio_foto').value
   const anuncios = "https://api.unsplash.com/photos/random/?client_id=d0jNPF9yZhDcFyIvIZqdG8YnmaP3pYBYfyYZqFpAdqE&query=" + anuncio_foto
   async function logPicturesAnuncio() {
      const response = await fetch(anuncios);
      const pictures = await response.json();
      document.getElementById('anuncio1').setAttribute("src", pictures.urls.regular)
   }
   logPicturesAnuncio()

}
if (document.getElementById('evento_foto')) {
   const evento_foto = document.getElementById('evento_foto').value
   const eventos = "https://api.unsplash.com/photos/random/?client_id=d0jNPF9yZhDcFyIvIZqdG8YnmaP3pYBYfyYZqFpAdqE&query=" + evento_foto
   async function logPicturesEvento() {
      const response = await fetch(eventos);
      const pictures = await response.json();
      document.getElementById('evento1').setAttribute("src", pictures.urls.regular)
   }
   logPicturesEvento()
}
if (document.getElementById('cambiar_clave') || document.getElementById('ingreso')) {
   document.addEventListener('click', (e) => {
      if (e.target.getAttribute('id') == 'ver_clave_actual' || e.target.getAttribute('id') == 'ver_clave_nueva' || e.target.getAttribute('id') == 'ver_confirmar_clave' || e.target.getAttribute('id') == 'ver_clave') {
         console.log(e.target.getAttribute('id'), e.target.getAttribute('id').substr(4))
         const element_id = e.target.getAttribute('id')
         if (document.getElementById(e.target.getAttribute('id').substr(4)).getAttribute('type') == 'password') {
            document.getElementById(e.target.getAttribute('id').substr(4)).setAttribute('type', 'text')
            document.getElementById(element_id).classList.remove('fa-solid', 'fa-eye')
            document.getElementById(element_id).classList.add('fa-solid', 'fa-eye-slash')
         } else {
            document.getElementById(e.target.getAttribute('id').substr(4)).setAttribute('type', 'password')
            document.getElementById(element_id).classList.remove('fa-solid', 'fa-eye-slash')
            document.getElementById(element_id).classList.add('fa-solid', 'fa-eye')
         }
      }
   })
   if (document.getElementById('cambiar_clave')) {
      const cambiar_clave = document.getElementById('cambiar_clave')
      document.getElementById('btn_cancelar').addEventListener('click', () => {
         location.reload()
      })
      cambiar_clave.addEventListener('submit', (event) => {
         if (!cambiar_clave.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
         } else {
            const dataform = new FormData(cambiar_clave)
            procesar_formularios_core(dataform, event)
         }
         cambiar_clave.classList.add('was-validated')
      })
   }
   if (document.getElementById('ingreso')) {
      const ingreso = document.getElementById('ingreso')
      ingreso.addEventListener('submit', (event) => {
         if (!ingreso.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
         } else {
            const dataform = new FormData(ingreso)
            procesar_formularios_core(dataform, event)
         }
         ingreso.classList.add('was-validated')
      })
   }
}
if (document.getElementById('impbuscar')) {
   const buscar = document.getElementById('impbuscar');
   const resultados = document.getElementById('resultados');
   const btn_cerrar = document.getElementById('btn_cerrar');
   const resultados_busqueda = document.getElementById('resultados_busqueda')
   var typingTimer = 0;

   buscar.addEventListener('keyup', f_mostrar_resultados)
   btn_cerrar.addEventListener('touchstart', f_cerrar_resultados)
   btn_cerrar.addEventListener('click', f_cerrar_resultados)

   function f_mostrar_resultados() {
      clearTimeout(typingTimer)
      typingTimer = setTimeout(f_obtener_resultados, 500)
   }
   function f_obtener_resultados() {
      resultados.classList.remove('invisible')
      resultados.style.height = 'auto'
      if (buscar.value != '') {
         const url = resultados_busqueda.dataset.url + buscar.value
         const msg = resultados_busqueda.dataset.msg
         fetch(url)
            .then((res) => res.json())
            .then((data) => {
               if (data.length) {
                  resultados_busqueda.innerHTML = `
                     <ul>
                        ${data.map(item => `<li><a class="text-black" href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                     </ul>`
               } else {
                  resultados_busqueda.innerHTML = msg
               }
            })
            .catch((err) => console.log(err));
      } else {
         resultados.classList.add('invisible')
      }
   }
   function f_cerrar_resultados() {
      buscar.value = ""
      buscar.focus()
      resultados.classList.add('invisible')
   }
}
if (document.getElementById('csvfilefrm')) {
   const form = document.getElementById('csvfilefrm')
   document.getElementById('csvfile').addEventListener('change', function () {
      const csvfile = document.getElementById('csvfile').value
      const csvfile2 = csvfile.split('\\')
      document.getElementById('lbl_csvfile').innerHTML = csvfile2[2]
   })

   document.getElementById('csvfilefrm').addEventListener('submit', (event) => {
      event.preventDefault()
      const dataform = new FormData(form)
      Swal.fire({
         title: 'Procesando Archivo CSV',
         html: `<i class="fs-1 text-secondary fa-solid fa-spinner fa-spin-pulse"></i>`,
         showConfirmButton: false
      })
      //   procesar_formularios_core(dataform, event)
   })
}


async function procesar_formularios_core(dataform, event) {
   event.preventDefault()
   event.stopPropagation()

   /*
   for (var pair of dataform.entries()) {
      var nombre = pair[0];
      var valor = pair[1];
      console.log("Nombre:", nombre, "Valor:", valor);
   }
   */
   const request = new Request(
      dataform.get('endpoint'), {
      method: 'POST',
      body: dataform,
   })

   try {
      const response = await fetch(request)
      const data = await response.json()
      if (data.success) {
         Swal.fire({
            icon: 'success',
            title: data.data.titulo,
            showConfirmButton: false,
            showClass: {
               popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
               popup: 'animate__animated animate__fadeOutUp'
            },
            text: data.data.msg,
            timer: 2000
         });
         setTimeout(() => {
            if (event.submitter.name = 'ingreso') {
               window.location = dataform.get('redireccion')
            } else {
               location.reload()
            }
         }, 2000);
         console.log(data.data)
      } else {
         console.log('ERROR', data)
         Swal.fire({
            icon: 'error',
            title: data.data.titulo,
            showClass: {
               popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
               popup: 'animate__animated animate__fadeOutUp'
            },
            text: data.data.msg,
            showConfirmButton: false,
            timer: 4000
         });
      }
   } catch (error) {
      console.log('Error: ', error)
   }
}
