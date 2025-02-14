<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Updated</title>
</head>
<body>
    <h2>Your Business Claim has been Updated</h2>
    <p>Dear {{ $business->user->first_name }} {{ $business->user->last_name }},</p>
    <p>Your business claim has been reviewed, and the ownership has been updated. The business with ID: <strong>{{ $business->id }}</strong> now belongs to the user with ID: <strong>{{ $business->user_id }}</strong>.</p>
    <p><strong>Business Name:</strong> {{ $business->name }}</p>
    <p><strong>Updated Ownership:</strong> {{ $business->user->first_name }} {{ $business->user->last_name }}</p>

    <p>If you have any questions or concerns, feel free to contact us.</p>
    <p>Thank you for your cooperation.</p>

    <p>Best Regards,</p>
    <p>The Ideal-Spot Team</p>
</body>
</html>
