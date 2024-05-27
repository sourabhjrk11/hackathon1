<?php
function generate_name($first_names, $last_names) {
    $first_name = $first_names[array_rand($first_names)];
    $last_name = $last_names[array_rand($last_names)];
    return "$first_name $last_name";
}

function mask_phone_number($phone_number) {
    return "***-***-" . substr($phone_number, -4);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_records = (int)$_POST["num_records"];

    // Sample first and last names
    $first_names = ["John", "Jane", "Alex", "Emily", "Chris", "Katie", "Mike", "Laura"];
    $last_names = ["Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis"];

    // Create CSV file
    $csv_file = fopen("user_data.csv", "w");
    fputcsv($csv_file, ["Email", "Name", "CreditScore", "CreditLines", "MaskedPhoneNumber"]);

    for ($i = 1; $i <= $num_records; $i++) {
        $email = "user$i@example.com";
        $name = generate_name($first_names, $last_names);
        $credit_score = rand(500, 850);
        $credit_lines = rand(1, 5);
        $phone_number = str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);
        $masked_phone = mask_phone_number($phone_number);

        fputcsv($csv_file, [$email, $name, $credit_score, $credit_lines, $masked_phone]);
    }

    fclose($csv_file);

    echo "CSV file generated successfully. <a href='user_data.csv'>Download CSV</a>";
}
?>
