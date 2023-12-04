<?php
global $user;
global $profile;
?> 

<h1>Create an Invoice</h1>
    <form action="process_invoice.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br><br>
        <label for="invoice_date">Invoice Date:</label>
        <input type="date" name="invoice_date" required><br><br>
        <label for="amount">Amount:</label>
        <input type="text" name="amount" required><br><br>
        <input type="submit" value="Create Invoice">
    </form>