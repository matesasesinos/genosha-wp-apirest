<div class="wrap">
    <h1>Opciones</h1>
    <p>Algunas opciones de configuración básica de la API.</p>
    <form method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>Ambiente</th>
                    <td>
                        <select name="genosha-api-enviroment">
                            <option value="dev" <?php function_exists('api_get_enviroment') && api_get_enviroment() ? selected('dev',api_get_enviroment(), true) : '' ?> >Desarrollo</option>
                            <option value="prod" <?php function_exists('api_get_enviroment') && api_get_enviroment() ? selected('prod',api_get_enviroment(), true) : '' ?>>Producción</option>
                        </select>
                        <p class="description">
                            El ambiente de Desarrollo acepta administradores como usuario de test (api key), el ambiente de producción es de solo lectura, es decir para el rol más bajo: suscriptor
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <button type="submit" name="genosha-api-save-options" class="button button-primary">Guardar</button>
        </p>
    </form>
</div>