<!-- resources/views/emails/subscription/renewed.blade.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscription Successfully Renewed</title>
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
            background-color: #d4edda;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #28a745;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
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
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
	</style>
</head>
<body>
<div class="container">
	<div class="header">
		<h1>Subscription Successfully Renewed</h1>
	</div>

	<div class="content">
		<p>Dear {{ $subscription->user->name }},</p>

		<div class="success">
			<p>Great news! Your <strong>{{ $planName }}</strong> subscription has been successfully renewed.</p>
		</div>

		<p>Thank you for continuing your journey with us. Your subscription has been renewed, and you'll continue to enjoy uninterrupted access to our services.</p>

		<div class="details">
			<p><strong>Plan:</strong> {{ $planName }}</p>
			<p><strong>Amount:</strong> {{ $currency }} {{ $amount }}</p>
			<p><strong>Billing Cycle:</strong> {{ ucfirst($subscription->plan_interval) }}</p>
			<p><strong>Next Billing Date:</strong> {{ $nextBillingDate }}</p>
		</div>

		<p>You can access your subscription details and billing history through your account dashboard.</p>

		<a href="{{ $billingPortalUrl }}" class="button">View Subscription</a>

		<p>If you have any questions or need assistance, our support team is always here to help.</p>

		<p>Thank you for your continued support!</p>

		<p>Best regards,<br>Your Company Name</p>
	</div>

	<div class="footer">
		<p>This email was sent to {{ $subscription->user->email }}</p>
		<p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
		<p>You can manage your email preferences in your <a href="{{ route('profile.settings') }}">account settings</a>.</p>
	</div>
</div>
</body>
</html>