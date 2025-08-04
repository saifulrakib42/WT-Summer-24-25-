!<!DOCTYPE html>
<html>
    <head>
        <title>
            Donation Form
        </title>
        <link rel="stylesheet" href="../CSS/style.css">
        <script src="../JS/valid.js" defer></script>
    </head>
    <body>
        <h2>Donation Form</h2>
        <form id="donationForm">
            <level for="name">Name:</level>
            <input type="text" id="name" name="name">

            <level for="email">Email:</level>
            <input type="email" id="email" name="email">

            <level for="phone">Phone:</level>
            <input type="text" id="phone" name="phone" maxlength="11">

            <level for="password">Password:</level>
            <input type="password" id="password" name="password">

            <level for="amount">Donation Amount:</level>
            <input type="number" id="amount" name="amount">

            <level>Payment Method:</level>
            <div class="radio-group">
                <input type="radio" name="payment" value="Credit Card"> Credit Card
                <input type="radio" name="payment" value="Bkash"> Bkash
                <input type="radio" name="payment" value="Nagad"> Nagad
            </div>

            <label class="terms">
                <input type="checkbox" id="terms"> I agree to the terms & conditions
            </label>

            <button type="submit">Donate</button>

        </form>
    </body>
</html>