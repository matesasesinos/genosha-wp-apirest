<div class="wrap">
    <h1>Generar key de autorización</h1>
    <table class="form-table">
        <tbody>
            <tr>
                <th>Sus datos</th>
                <td>
                    <input type="text" id="api-generate-key" class="regular-text" value="" placeholder="user:password-app"> <button class="button" id="api-generate-auth">Generar</button>
                    <p class="description">En el campo agrege su usuario seguido de : (dos puntos) y la contreseña de aplicación.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="api-auth">
        <p>Key generada: <span id="api-key-generate"></span></p>
        <p>Ej. fetch:</p>
        <pre class="api-help-code">
            async function getProjects() {
                const projects = await fetch(url-to-api, {
                        method: 'GET',
                        headers: {
                            'Authorization' : 'Basic <span id="api-key-generate-example"></span>'
                        }
                });
                return await projects.json();
            }
        </pre>
    </div>
</div>