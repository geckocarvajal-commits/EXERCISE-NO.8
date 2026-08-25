
<?php
$errors = [];
$success = "";

$age = "";
$gender = "";
$email = "";
$address = "";
$contact = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $age = trim($_POST["age"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $contact = trim($_POST["contact"] ?? "");

    if ($age === "" || !filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 120) {
        $errors[] = "Please enter a valid age.";
    }

    if (!in_array($gender, ["Male", "Female", "Other"])) {
        $errors[] = "Please select a valid gender.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($address === "") {
        $errors[] = "Address is required.";
    }

    if (!preg_match("/^[0-9+\-\s]{7,20}$/", $contact)) {
        $errors[] = "Please enter a valid contact number.";
    }

    if (empty($errors)) {
        $success = "Information submitted successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Output #1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Personal Information</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Age</label>
        <input
            type="number"
            name="age"
            min="1"
            max="120"
            value="<?= htmlspecialchars($age) ?>"
            required
        >

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($email) ?>"
            required
        >

        <label>Address</label>
        <textarea
            name="address"
            rows="3"
            required
        ><?= htmlspecialchars($address) ?></textarea>

        <label>Contact Number</label>
        <input
            type="tel"
            name="contact"
            value="<?= htmlspecialchars($contact) ?>"
            required
        >

        <button type="submit">Submit</button>

    </form>

</div>

</body>
</html>