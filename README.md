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

[![Product Name Screen Shot][product-screenshot]](https://example.com)

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

- npm
  ```sh
  npm install npm@latest -g
  ```

### Instalación

Instrucciones de instalación

1. Get a free API Key at [https://example.com](https://example.com)
2. Clone the repo
   ```sh
   git clone https://github.com/github_username/repo_name.git
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Enter your API in `config.js`
   ```js
   const API_KEY = 'ENTER YOUR API';
   ```
5. Change git remote url to avoid accidental pushes to base project
   ```sh
   git remote set-url origin github_username/repo_name
   git remote -v # confirm the changes
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

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

Implementación de webpack, modificar themesetup e incluir fghegc.scss

### Leccion-04

Implementación del index.php dinámico modificando la clase core.php. Creación del View con plantillas en blanco sin agregarpost, comentarios y navegación.

### Leccion-05

### Leccion-06

### Leccion-07

### Leccion-08

### Leccion-09

### Leccion-10

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
