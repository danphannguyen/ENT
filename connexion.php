<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>Université Gustave Eiffel</title>
</head>

<body>

    <div id="headerConnexion">
        <img src="./svg/symbLogo.svg" alt="">
        <img src="./svg/typoLogo.svg" alt="">
    </div>

    <section id="sectionConnexion">
        <div id="containerConnexion" class="dc-center">
            <h1>Connexion</h1>
            <form id="formConnexion" class="dc-center" action="connexion.php" method="post">

                <div class="inputFormConnexion">
                    <input type="email" name="mail" id="mailConnexion" placeholder="Email" required>
                </div>

                <div class="inputFormConnexion">
                    <input type="password" name="password" id="passwordConnexion" placeholder="Mot de passe" required>
                    <div id="eyeButton" onclick="">
                        <img id="eyeImg" src="./svg/show.svg" alt="">
                    </div>
                </div>

                <div id="submitContainerConnexion" class="dc-center">
                    <input type="submit" value="Se connecter">
                    <a href="">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const togglePassword = document.querySelector('#eyeButton');
        const password = document.querySelector('#passwordConnexion');
        var image = document.getElementById("eyeImg");
        var isImage1 = true;

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye / eye slash icon
            this.classList.toggle('bi-eye');

            if (isImage1) {
                image.src = "./svg/hide.svg";
            } else {
                image.src = "./svg/show.svg";
            }

            // Invert the state for the next click
            isImage1 = !isImage1;
        });
    </script>

</body>

</html>