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
}
