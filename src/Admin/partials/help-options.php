<div class="wrap">
    <h1 style="margin-bottom:1%">Ayuda</h1>
    <p>Nota Importante: en <code>wp-config.php</code> debe estar definida la constante <code>define('ALLOW_UNFILTERED_UPLOADS', true);</code> o no se podrán subir algunos tipos de archivos.</p>
    <div class="api-help-card">
        <h2 class="api-help-title">1 - Polylang</h2>
        <div class="api-help-content">
            <p>Polylang es un plugin para traducciones a muchos idiomas. Una vez instalado, debe configurar el tipo de post en <strong>Idiomas</strong> > <strong>Configuración</strong> > <strong>Tipos de contenido personalizado y taxonomías</strong>. Por defecto, los tipos de post que son personalizados no vienen pre configurados en Polylang (incluso si el plugin se instalo luego de la creación del tipo de post), por este motivo hay que activarlo para tener traducciones (ver imágen de abajo).</p>
            <p>
                <img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-polylang-settings.png" alt="">
            </p>
        </div>
    </div>
    <div class="api-help-card">
        <h2 class="api-help-title">2 - Contraseña de Aplicación (Conexión a API)</h2>
        <div class="api-help-content">
            <p>Para conectarse a la API se necesita un usuario y un password de aplicación ya que estos datos deben enviarse en la cabecera de la petición.</p>
            <p>Los tipos de roles usuario admitidos son <strong>administrator</strong> y <strong>subscriber</strong>, todos los demas roles estan bloqueados para el acceso a la API, se recomienda usar <strong>subscriber</strong> que es un usuario solo con permisos GET.</p>
            <p>Para crear un usuario debe dirigirse a <strong>Usuarios</strong> > <strong>Añadir nuevo</strong></p>
            <p>
                <img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new.png" alt="">
            </p>
            <p>Llene los campos con los datos del usuario y genere o escriba una contraseña. Esta contraseña le da acceso al usuario al backoffice (interface de administración de WordPress) pero no a la API:</p>
            <p>
                <img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new-data.png" alt="">
            </p>
            <p>Una vez creado el usuario puede generar una contraseña de aplicación, ingresando a editar el usuario y buscando la opción en la parte de abajo.</p>
            <p><img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new-list.png" alt=""></p>
            <p><img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new-app-ps.png" alt=""></p>
            <p>En esta parte agregamos un nombre descriptivo para la conexión y hacemos click en <strong>Añadir una nueva contraseña de aplicación</strong></p>
            <p><img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new-app-ps-2.png" alt=""></p>
            <p>Este proceso nos genera la contraseña que podemos usar para conectar a nuestra API</p>
            <p><img src="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/help-users-new-app-ps-3.png" alt=""></p>
        </div>
    </div>
    <div class="api-help-card">
        <h2 class="api-help-title">3 - Conexión a API</h2>
        <div class="api-help-content">
            <p>Para realizar la conexión a cualquier endpoint de la API Rest debe enviar una cabecera de autorización como la siguiente:</p>
            <p>
                <code class="api-help-code">
                    Authorization: Basic base64_encode(user:password-app)
                </code>
            </p>
            <p>Donde <strong>user</strong> es el usuario a conectar y <strong>password-app</strong> es la contraseña de aplicación generada (ver punto 2 de esta ayuda).</p>
            <p>Como se ve en el ejemplo, el <strong>user</strong> seguido de <strong>:</strong> (dos puntos) y la <strong>contraseña</strong> deben ir con un encode de base 64, lo que nos deja una cabecera como la siguiente:</p>
            <p>
                <code class="api-help-code">
                    "Authorization":"Basic YXBpUmVzdEdlbm9zaGF2MzpweUc2IDlETTIgUzB5eCBCUEd5IDRmbHEgb2lxWA=="
                </code>
            </p>
            <p>La cadena en base64 se puede generar con <strong><a href="https://developer.mozilla.org/en-US/docs/Web/API/btoa" target="blank">btoa()</a></strong></p>
            <p>También puede enviar la cadena ya codificad, puede generar la key en este link: <a href="<?php echo admin_url('admin.php?page=genosha-api-auth')?>">Generar cadena</a></p>
        </div>
    </div>
</div>