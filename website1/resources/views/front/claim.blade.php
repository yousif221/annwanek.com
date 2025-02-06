<!DOCTYPE html>
<html>
<head>
    <title>Claim Acknowledgment</title>
</head>
<body>
    <h2>Thank You for Your Business Claim</h2>
    <p>Dear {{ $review->first_name }},</p>
    <p>We have received your claim for the business with name: <strong>{{ $review->business->name }}</strong>.</p>
    <p>Here is the information you submitted:</p>
    <p><strong>Description:</strong></p>
    <p>{{ $review->description }}</p>
    @if (!empty($review->file))
        <p><strong>Attachment:</strong></p>
        <p>You can download the file you uploaded using the link below:</p>
        <p><a href="{{ asset( $review->file) }}" download>Download File</a></p>
    @endif
    <p>Our team will review your claim and contact you shortly.</p>
    <p>Thank you for reaching out to us.</p>

    <p>Best Regards,</p>
    <p>The Ideal-Spot Team</p>
</body>
</html>
