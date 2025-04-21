<!-- resources/views/emails/subscription/renewal-notice.blade.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscription Renewal Notice</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #0066cc;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #0066cc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        .details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
	</style>
</head>
<body>
<div class="container">
	<div class="header">
		<h1>Subscription Renewal Notice</h1>
	</div>

	<div class="content">
		<p>Dear {{ $subscription->user->name }},</p>

		<p>This is a friendly reminder that your <strong>{{ $planName }}</strong> subscription is scheduled to renew on <strong>{{ $endDate }}</strong>.</p>

		<div class="details">
			<p><strong>Plan:</strong> {{ $planName }}</p>
			<p><strong>Amount:</strong> {{ $currency }} {{ $amount }}</p>
			<p><strong>Renewal Date:</strong> {{ $endDate }}</p>
			<p><strong>Billing Cycle:</strong> {{ ucfirst($subscription->plan_interval) }}</p>
		</div>

		<p>If you wish to continue enjoying our services, no action is required. Your subscription will be automatically renewed on the date mentioned above.</p>

		<p>If you wish to make any changes to your subscription, please visit your account settings.</p>

		<a href="{{ route('billing.portal', ['user' => $subscription->user_id]) }}" class="button">Manage Subscription</a>

		<p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>

		<p>Thank you for being a valued customer!</p>

		<p>Best regards,<br>Your Company Name</p>
	</div>

	<div class="footer">
		<p>This email was sent to {{ $subscription->user->email }}</p>
		<p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
	</div>
</div>
</body>
</html>