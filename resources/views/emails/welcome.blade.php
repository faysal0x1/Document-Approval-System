@component('mail::message')
	# Welcome to {{ config('app.name') }}, {{ $user->name }}!

	Your ERPS account for **{{ $company->name }}** has been successfully created.

	## Your Account Details

	**Company:** {{ $company->name }}
	**Your Name:** {{ $user->name }}
	**Email:** {{ $user->email }}
	**Role:** {{ ucfirst($user->role) }}

	## Your Selected Modules
	@component('mail::panel')
		@foreach($modules as $module)
			- **{{ $module->name }}**: {{ $module->description }}
		@endforeach
	@endcomponent

	## Company Settings
	- **Currency:** {{ $company->currency }}
	- **Timezone:** {{ $company->timezone }}
	- **Date Format:** {{ $company->date_format }}

	@component('mail::button', ['url' => $loginUrl, 'color' => 'primary'])
		Login to Your Account
	@endcomponent

	## Next Steps

	1. **Complete Your Setup**: Set up your company profile and customize your workspace
	2. **Invite Team Members**: Add your team to make the most of your new ERPS system
	3. **Configure Your Modules**: Set up each module according to your business needs
	4. **Import Your Data**: Transfer your existing data into the system

	@component('mail::button', ['url' => $setupGuideUrl])
		View Setup Guide
	@endcomponent

	If you have any questions, please don't hesitate to contact our support team at [{{ $supportEmail }}](mailto:{{ $supportEmail }}).

	Thanks,<br>
	The {{ config('app.name') }} Team
@endcomponent