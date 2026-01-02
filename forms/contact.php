<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // إعداد البريد الإلكتروني المستلم
    $to = "mohamedmostafa12127@gmail.com"; // ضع بريدك هنا
    $subject = "New Contact Message from Website";

    // أخذ البيانات من الفورم
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subjectForm = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // تحقق من البيانات
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form correctly.";
        exit;
    }

    // تجهيز محتوى الرسالة
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subjectForm\n\n";
    $email_content .= "Message:\n$message\n";

    // تجهيز الرؤوس
    $headers = "From: $name <$email>";

    // إرسال البريد
    if(mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Your message has been sent. Thank you!";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, your message was not sent.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
