<!DOCTYPE html>
<html>
<head>
    <title>New Business Claim</title>
</head>
<body>
    <h2>New Business Claim Submitted</h2>
    <p><strong>Name:</strong> {{ $review->first_name }}</p>
    <p><strong>Email:</strong> {{ $review->first_name }}</p>
    <p><strong>Business ID:</strong> {{ $review->business_id }}</p>
    <p><strong>Description:</strong></p>
    <p>{{ $review->description }}</p>

    @if (!empty($review->file))
        <p><strong>Attachment:</strong></p>
        <p>You can download the file you uploaded using the link below:</p>
        <p><a href="{{ asset( $review->file) }}" download>Download File</a></p>
    @endif
       
</body>
</html>
