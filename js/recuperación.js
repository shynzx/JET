document.addEventListener("DOMContentLoaded", function () {
    const sendCodeButton = document.getElementById("sendCode");
    const verifyCodeButton = document.getElementById("verifyCode");
    const recoverForm = document.getElementById("recoverForm");

    sendCodeButton.addEventListener("click", function () {
        const email = recoverForm.querySelector('input[name="email"]').value;
        // Aquí agregas la lógica para enviar el código de verificación al email
        // Ejemplo de una petición fetch para enviar el email (puedes ajustar según tu backend)
        /*fetch('enviar-codigo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email: email }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("step1").style.display = "none";
                document.getElementById("step2").style.display = "block";
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });*/
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    });

    verifyCodeButton.addEventListener("click", function () {
        const verificationCode = recoverForm.querySelector('input[name="verificationCode"]').value;
        // Aquí agregas la lógica para verificar el código
        // Ejemplo de una petición fetch para verificar el código (puedes ajustar según tu backend)
        /*fetch('verificar-codigo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ verificationCode: verificationCode }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("step2").style.display = "none";
                document.getElementById("step3").style.display = "block";
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });*/
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "block";
    });

    recoverForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const newPassword = recoverForm.querySelector('input[name="newPassword"]').value;
        const confirmPassword = recoverForm.querySelector('input[name="confirmPassword"]').value;
        if (newPassword !== confirmPassword) {
            alert("Las contraseñas no coinciden");
            return;
        }
        // Aquí agregas la lógica para cambiar la contraseña
        // Ejemplo de una petición fetch para cambiar la contraseña (puedes ajustar según tu backend)
        fetch('cambiar-contrasena.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ newPassword: newPassword }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Contraseña cambiada exitosamente");
                window.location.href = "login.html";
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

});
