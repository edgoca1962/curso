import Swal from "sweetalert2"

document.addEventListener('submit', (event) => {
   const form = event.target
   if (form.getAttribute('id') && form.getAttribute('id').substr(0, 8) === 'articulo') {
      const dataform = new FormData(form)
      dataform.append('action', event.submitter.name)
      procesar_formularios_post(dataform, event)
   }
   if (event.submitter.name === 'post_compartir') {
      const element_id = 'post_compartir_' + form.getAttribute('id').substr(13)
      const element = document.getElementById(element_id)
      const postUrl = encodeURIComponent(element.dataset.enlace)
      const shareUrl = 'https://api.whatsapp.com/send?text=' + postUrl
      window.open(shareUrl, '_blank')
   }
})

async function procesar_formularios_post(dataform, event) {
   event.preventDefault()
   event.stopPropagation()
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
            location.reload()
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
