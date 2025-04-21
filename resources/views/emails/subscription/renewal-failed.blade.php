<!-- resources/views/emails/subscription/renewal-failed.blade.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscription Payment Failed</title>
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
            background-color: #f8d7da;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #dc3545;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #dc3545;
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
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
	</style>
</head>
<body>
<div class="container">
	<div class="header">
		<h1>Subscription Payment Failed</h1>
	</div>

	<div class="content">
		<p>Dear {{ $subscription->user->name }},</p>

		<div class="alert">
			<p>We've encountered an issue processing the payment for your <strong>{{ $planName }}</strong> subscription.</p>
		</div>

		<p>We attempted to charge your payment method for the renewal of your subscription, but the payment was declined.</p>

		<div class="details">
			<p><strong>Plan:</strong> {{ $planName }}</p>
			<p><strong>Amount:</strong> {{ $currency }} {{ $amount }}</p>
			<p><strong>Billing Cycle:</strong> {{ ucfirst($subscription->plan_interval) }}</p>
		</div>

		<p><strong>What to do next:</strong></p>
		<ol>
			<li>Please check that your payment method is up to date</li>
			<li>Ensure there are sufficient funds available</li>
			<li>Update your payment information in your account settings</li>
		</ol>

		<p>Your subscription is currently on hold. To restore your access, please update your payment details as soon as possible.</p>

		<a href="{{ $billingPortalUrl }}" class="button">Update Payment Method</a>

		<p>If you need any assistance, our support team is always ready to help.</p>

		<p>Thank you for your prompt attention to this matter.</p>

		<p>Best regards,<br>Your Company Name</p>
	</div>

	<div class="footer">
		<p>This email was sent to {{ $subscription->user->email }}</p>
		<p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
	</div>
</div>
</body>
</html>