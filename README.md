<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->

<a id="readme-top"></a>

<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->

<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/edgoca1962/curso">
    <img src="wp-content/themes/leccion08/assets/img/fghnegrofblanco.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Tema dinámico para Wordpress (Framework)</h3>

  </div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Contenido</summary>
  <ol>
    <li>
      <a href="#about-the-project">Acerca del Curso</a>
      <ul>
        <li><a href="#built-with">Construido con</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Para iniciar</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Instalación</a></li>
      </ul>
    </li>
    <li><a href="#usage">Uso</a></li>
    <li><a href="#roadmap">Lecciones del Curso</a></li>
      <ul>
        <li><a href="#leccion-01">Lección 01</a></li>
        <li><a href="#leccion-02">Lección 02</a></li>
        <li><a href="#leccion-03">Lección 03</a></li>
        <li><a href="#leccion-04">Lección 04</a></li>
        <li><a href="#leccion-05">Lección 05</a></li>
        <li><a href="#leccion-06">Lección 06</a></li>
        <li><a href="#leccion-07">Lección 07</a></li>
        <li><a href="#leccion-08">Lección 08</a></li>
        <li><a href="#leccion-09">Lección 09</a></li>
        <li><a href="#leccion-10">Lección 10</a></li>
      </ul>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## Acerca del Curso

Incluir en esta parte una descripción del curso

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Para Iniciar

Incluir la instrucciones para el inicio del curso

### Pre-requisitos

Incluir los prerequisitos para la lección 1

### Instalación

Instrucciones de instalación

1. Obtener la aplicación Local en [https://localwp.com/](https://localwp.com/)
2. En caso de no tener Node.js, obtenerla en [https://nodejs.org/en/download/package-manager](https://nodejs.org/en/download/package-manager)
3. Verificar la versión de node en Terminal (MAC):
   ```sh
   node -v
   ```
4. Verificar la versión de NPM en Terminal (MAC):
   ```sh
   npm -v
   ```

<!-- USAGE EXAMPLES -->

## Uso

Descipción para el uso de la primera lección
_For more examples, please refer to the [Documentation](https://example.com)_

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->

## Curso

### Leccion-01

Implementación de Namespaces, Singleton, Treats

```sh
<?php body_class($core->get_atributo('body')) ?> style="<?php echo $core->get_atributo('height') ?>"
```

### Leccion-02

Implementación de Bootstrap, sweetAlert, Annimate y FontAwesome en function.php

#### function.php

```sh
wp_enqueue_style('styles', MYDOMAIN_DIR_STYLE, array(), microtime(), 'all');
wp_enqueue_style('bootstrapStyles', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", array(), '5.3.3', 'all');
wp_enqueue_style('Animate', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css", array(), '', 'all');


wp_enqueue_script('scripts', MYDOMAIN_DIR_URI . '/assets/main.js', array('jquery'), null, true);
wp_enqueue_script('BootstrapScripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js", array('jquery'), '5.3.3', true);
wp_enqueue_script('SweetAlert2', "https://cdn.jsdelivr.net/npm/sweetalert2@11", array(), '2.11', true);
wp_enqueue_script('FontAwesome', "https://use.fontawesome.com/releases/v5.15.4/js/all.js", array(), '5.15.4', true);
```

#### index.php

```sh
<div class="d-flex justify-content-center align-items-center" style="<?php echo $core->get_atributo('height') ?>">
   <h3 class="animate__animated animate__bounceInDown">Página principal</h3>
</div>
```

#### Console

```sh
Swal.fire({
title: "Good job!",
text: "You clicked the button!",
icon: "success"
});
```

### Leccion-03

(Implementación de webpack, modificar themesetup e incluir fghegc.scss)
En este implementación se hizo un folder dentro de wp-contents llamado webpack y que es en donde se ejecutará el siguiente comando en Terminal (MAC) la instalación de los paquetes que se utilizarán para la conformación de un solo archivo main.css y main.js.

<p><a href="wp-content/webpack/package.json">Archivo package.json</a></p>

#### Terminal

Instalar las últimas versiones de los módulos incluidos en el archivo package.json:

```sh
sudo npm install -g npm@latest
```

#### Folder webpack

Crear el archivo webpack.config.cjs. En el siguiente enlace se puede ver el contenido del archivo.

Hay tres lugares en donde se debe modificar este archivo, en la línea 7 que es en donde se indica el nombre del archivo fuente que en este parte del curso es source11.js. En la línea 12 que es en donde se indica el nombre del tema y el folder en donde se almacenarán los archivos CSS y JS y que en este caso es leccion11/assets/. Por último, se debe modificar la línea 34 que es donde se indica el servidor de la aplicación WP Local.

<p><a href="wp-content/webpack/webpack.config.cjs">Configurar Webpack</a></p>

### Leccion-04

Implementación del index.php dinámico modificando la clase core.php. Creación del View con plantillas en blanco sin agregarpost, comentarios y navegación con imagen de usuario y configuración de bootstrap en sccs

### Leccion-05

Se incluye lógica para traer atributos de los diferentes módulos que se crearán.

### Leccion-06

Se incluyen imágenes para configurar el tema principal y se crea el primer módulo para manejar el Blog

### Leccion-07

Manejo indivualizado de parametros para los posts como bg, imagen, etc.

### Leccion-08

Implementación de los template con todos los parámetros. Implementación de css y js para core. El js implementa el cambio de ojo en los campos tipo password en el core

### Leccion-09

Implementación de la lógica de login y cambio de clave como core. En el js se implementa el envío de formularios para el core.

### Leccion-10

Implementación de js para el mdulo post para el comportamiento de los botones de mantenimiento y para compartir en whatsapp y el envío de formularios del módulo separado del core.

### Leccion-11

Implementación de la captura masiva de de custom posts.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->

## Contributing

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Your Name - [@your_twitter](https://twitter.com/your_username) - email@example.com

Project Link: [https://github.com/your_username/repo_name](https://github.com/your_username/repo_name)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

<p align="right">(<a href="#readme-top">back to top</a>)</p>
