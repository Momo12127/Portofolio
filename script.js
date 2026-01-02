(function() {
    emailjs.init("B3zVQ2zDR5ZyBtvs7"); // Your EmailJS public key
})();

window.onload = function() {
    const form = document.getElementById("contactForm");
    const loading = form.querySelector(".loading");
    const errorMsg = form.querySelector(".error-message");
    const sentMsg = form.querySelector(".sent-message");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        loading.style.display = "block";
        errorMsg.style.display = "none";
        sentMsg.style.display = "none";

        const templateParams = {
            from_name: document.getElementById("name").value,
            from_email: document.getElementById("email").value,
            subject: document.getElementById("subject").value,
            message: document.getElementById("message").value
        };
        
        emailjs.send("service_49ev5qj", "template_67q40sq", templateParams)
            .then(function(response) {
                loading.style.display = "none";
                sentMsg.style.display = "block";
                form.reset();
                console.log("SUCCESS!", response.status, response.text);
            }, function(error) {
                loading.style.display = "none";
                errorMsg.style.display = "block";
                errorMsg.textContent = "Failed to send email. Check console for details.";
                console.error("FAILED...", error);
            });
    });
};
