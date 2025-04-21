<x-guest-layout>
	<div class="card shadow-lg border-0 rounded-lg">
		<div class="card-body p-5">
			<div class="border p-4 rounded bg-white">
				<div class="text-center">
					<h3 class="fw-bold mb-2">Sign Up for Your ERPS Solution</h3>
					<p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="link-primary">Sign
					                                                                                                   in
					                                                                                                   here</a>
					</p>
				</div>
				<div class="login-separater text-center mb-4">
					<span class="bg-white px-3">CREATE YOUR ACCOUNT</span>
					<hr/>
				</div>
				<div class="form-body">
					<form method="POST" action="{{ route('register') }}" class="row g-3" enctype="multipart/form-data">
						@csrf

						<!-- Company Information Section -->
						<div class="col-12 mb-3">
							<h5 class="fw-bold border-bottom pb-2">Company Information</h5>
						</div>

						<div class="col-sm-6">
							<label for="companyName" class="form-label">Company Name*</label>
							<input type="text" class="form-control @error('company_name') is-invalid @enderror"
							       id="companyName" placeholder="Your Company Name" name="company_name"
							       value="{{ old('company_name') }}" required>
							@error('company_name')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="companyEmail" class="form-label">Company Email*</label>
							<input type="email" class="form-control @error('company_email') is-invalid @enderror"
							       id="companyEmail" placeholder="info@yourcompany.com" name="company_email"
							       value="{{ old('company_email') }}" required>
							@error('company_email')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="companyPhone" class="form-label">Company Phone</label>
							<input type="tel" class="form-control @error('company_phone') is-invalid @enderror"
							       id="companyPhone" placeholder="+1 (123) 456-7890" name="company_phone"
							       value="{{ old('company_phone') }}">
							@error('company_phone')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="companyWebsite" class="form-label">Website</label>
							<input type="url" class="form-control @error('company_website') is-invalid @enderror"
							       id="companyWebsite" placeholder="https://yourcompany.com" name="company_website"
							       value="{{ old('company_website') }}">
							@error('company_website')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-12">
							<label for="companyAddress" class="form-label">Company Address</label>
							<textarea class="form-control @error('company_address') is-invalid @enderror"
							          id="companyAddress" name="company_address" rows="2"
							          placeholder="Enter your company address">{{ old('company_address') }}</textarea>
							@error('company_address')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="companyCurrency" class="form-label">Currency*</label>
							<select class="form-select @error('company_currency') is-invalid @enderror"
							        id="companyCurrency" name="company_currency">
								<option value="USD" {{ old('company_currency') == 'USD' ? 'selected' : '' }}>USD - US
								                                                                             Dollar
								</option>
								<option value="EUR" {{ old('company_currency') == 'EUR' ? 'selected' : '' }}>EUR -
								                                                                             Euro
								</option>
								<option value="GBP" {{ old('company_currency') == 'GBP' ? 'selected' : '' }}>GBP -
								                                                                             British
								                                                                             Pound
								</option>
								<option value="CAD" {{ old('company_currency') == 'CAD' ? 'selected' : '' }}>CAD -
								                                                                             Canadian
								                                                                             Dollar
								</option>
								<option value="AUD" {{ old('company_currency') == 'AUD' ? 'selected' : '' }}>AUD -
								                                                                             Australian
								                                                                             Dollar
								</option>
								<option value="INR" {{ old('company_currency') == 'INR' ? 'selected' : '' }}>INR -
								                                                                             Indian
								                                                                             Rupee
								</option>
								<option value="JPY" {{ old('company_currency') == 'JPY' ? 'selected' : '' }}>JPY -
								                                                                             Japanese
								                                                                             Yen
								</option>
								<!-- Add more currencies as needed -->
							</select>
							@error('company_currency')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="companyTimezone" class="form-label">Timezone*</label>
							<select class="form-select @error('company_timezone') is-invalid @enderror"
							        id="companyTimezone" name="company_timezone">
								<option value="UTC" {{ old('company_timezone') == 'UTC' ? 'selected' : '' }}>UTC
								</option>
								<option value="America/New_York" {{ old('company_timezone') == 'America/New_York' ? 'selected' : '' }}>
									Eastern Time (US & Canada)
								</option>
								<option value="America/Chicago" {{ old('company_timezone') == 'America/Chicago' ? 'selected' : '' }}>
									Central Time (US & Canada)
								</option>
								<option value="America/Denver" {{ old('company_timezone') == 'America/Denver' ? 'selected' : '' }}>
									Mountain Time (US & Canada)
								</option>
								<option value="America/Los_Angeles" {{ old('company_timezone') == 'America/Los_Angeles' ? 'selected' : '' }}>
									Pacific Time (US & Canada)
								</option>
								<option value="Europe/London" {{ old('company_timezone') == 'Europe/London' ? 'selected' : '' }}>
									London
								</option>
								<option value="Europe/Paris" {{ old('company_timezone') == 'Europe/Paris' ? 'selected' : '' }}>
									Paris
								</option>
								<option value="Asia/Tokyo" {{ old('company_timezone') == 'Asia/Tokyo' ? 'selected' : '' }}>
									Tokyo
								</option>
								<option value="Asia/Kolkata" {{ old('company_timezone') == 'Asia/Kolkata' ? 'selected' : '' }}>
									Mumbai, New Delhi
								</option>
								<!-- Add more timezones as needed -->
							</select>
							@error('company_timezone')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="companyLogo" class="form-label">Company Logo</label>
							<input type="file" class="form-control @error('company_logo') is-invalid @enderror"
							       id="companyLogo" name="company_logo" accept="image/*">
							@error('company_logo')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="dateFormat" class="form-label">Date Format</label>
							<select class="form-select @error('date_format') is-invalid @enderror" id="dateFormat"
							        name="date_format">
								<option value="d/m/Y" {{ old('date_format') == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY
								                                                                            (31/12/2023)
								</option>
								<option value="m/d/Y" {{ old('date_format') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY
								                                                                            (12/31/2023)
								</option>
								<option value="Y/m/d" {{ old('date_format') == 'Y/m/d' ? 'selected' : '' }}>YYYY/MM/DD
								                                                                            (2023/12/31)
								</option>
							</select>
							@error('date_format')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="timeFormat" class="form-label">Time Format</label>
							<select class="form-select @error('time_format') is-invalid @enderror" id="timeFormat"
							        name="time_format">
								<option value="12" {{ old('time_format') == '12' ? 'selected' : '' }}>12 Hour</option>
								<option value="24" {{ old('time_format') == '24' ? 'selected' : '' }}>24 Hour</option>
							</select>
							@error('time_format')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-4">
							<label for="firstDayOfWeek" class="form-label">First Day of Week</label>
							<select class="form-select @error('first_day_of_week') is-invalid @enderror"
							        id="firstDayOfWeek" name="first_day_of_week">
								<option value="0" {{ old('first_day_of_week') == '0' ? 'selected' : '' }}>Sunday
								</option>
								<option value="1" {{ old('first_day_of_week') == '1' ? 'selected' : '' }}>Monday
								</option>
								<option value="2" {{ old('first_day_of_week') == '2' ? 'selected' : '' }}>Tuesday
								</option>
								<option value="3" {{ old('first_day_of_week') == '3' ? 'selected' : '' }}>Wednesday
								</option>
								<option value="4" {{ old('first_day_of_week') == '4' ? 'selected' : '' }}>Thursday
								</option>
								<option value="5" {{ old('first_day_of_week') == '5' ? 'selected' : '' }}>Friday
								</option>
								<option value="6" {{ old('first_day_of_week') == '6' ? 'selected' : '' }}>Saturday
								</option>
							</select>
							@error('first_day_of_week')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<!-- Admin User Information Section -->
						<div class="col-12 mt-4 mb-3">
							<h5 class="fw-bold border-bottom pb-2">Admin User Information</h5>
						</div>

						<div class="col-sm-6">
							<label for="name" class="form-label">Full Name*</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
							       id="name" placeholder="John Doe" name="name" value="{{ old('name') }}" required>
							@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="email" class="form-label">Email Address*</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror"
							       id="email" placeholder="john@example.com" name="email" value="{{ old('email') }}"
							       required>
							@error('email')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="phone" class="form-label">Phone Number</label>
							<input type="tel" class="form-control @error('phone') is-invalid @enderror"
							       id="phone" placeholder="+1 (123) 456-7890" name="phone" value="{{ old('phone') }}">
							@error('phone')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="role" class="form-label">User Role*</label>
							<select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
							        required>
								<option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
								<option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager
								</option>
								<option value="hr-manager" {{ old('role') == 'hr-manager' ? 'selected' : '' }}>HR
								                                                                               Manager
								</option>
								<option value="finance-manager" {{ old('role') == 'finance-manager' ? 'selected' : '' }}>
									Finance Manager
								</option>
								<option value="accountant" {{ old('role') == 'accountant' ? 'selected' : '' }}>
									Accountant
								</option>
								<option value="auditor" {{ old('role') == 'auditor' ? 'selected' : '' }}>Auditor
								</option>
								<option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier
								</option>
								<option value="sales-executive" {{ old('role') == 'sales-executive' ? 'selected' : '' }}>
									Sales Executive
								</option>
								<option value="store-manager" {{ old('role') == 'store-manager' ? 'selected' : '' }}>
									Store Manager
								</option>
								<option value="storekeeper" {{ old('role') == 'storekeeper' ? 'selected' : '' }}>
									Storekeeper
								</option>
								<option value="purchasing-officer" {{ old('role') == 'purchasing-officer' ? 'selected' : '' }}>
									Purchasing Officer
								</option>
								<option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee
								</option>
							</select>
							@error('role')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-12">
							<label for="userAddress" class="form-label">Address</label>
							<textarea class="form-control @error('address') is-invalid @enderror"
							          id="userAddress" name="address" rows="2"
							          placeholder="Enter your address">{{ old('address') }}</textarea>
							@error('address')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="photo" class="form-label">Profile Photo</label>
							<input type="file" class="form-control @error('photo') is-invalid @enderror"
							       id="photo" name="photo" accept="image/*">
							@error('photo')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-sm-6">
							<label for="password" class="form-label">Password*</label>
							<div class="input-group" id="show_hide_password">
								<input type="password"
								       class="form-control border-end-0 @error('password') is-invalid @enderror"
								       id="password" placeholder="Enter Password" name="password" required>
								<a href="javascript:" class="input-group-text bg-transparent"><i
											class='bx bx-hide'></i></a>
								@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-text">Password must be at least 8 characters long</div>
						</div>

						<div class="col-sm-6">
							<label for="password_confirmation" class="form-label">Confirm Password*</label>
							<div class="input-group" id="show_hide_confirm_password">
								<input type="password" class="form-control border-end-0"
								       id="password_confirmation" placeholder="Confirm Password"
								       name="password_confirmation" required>
								<a href="javascript:" class="input-group-text bg-transparent"><i
											class='bx bx-hide'></i></a>
							</div>
						</div>

						<!-- Module Selection Section -->
						<div class="col-12 mt-4 mb-3">
							<h5 class="fw-bold border-bottom pb-2">Select ERPS Modules</h5>
							<p class="text-muted small">Choose the modules that best fit your business needs</p>
						</div>

						<div class="col-12">
							<div class="row g-3">
								@foreach($modules as $module)
									<div class="col-md-4 col-sm-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="modules[]"
											       value="{{ $module->id }}" id="module{{ $module->id }}"
													{{ (is_array(old('modules')) && in_array($module->id, old('modules'))) ? 'checked' : '' }}>
											<label class="form-check-label" for="module{{ $module->id }}">
												{{ $module->name }}
												<span class="text-muted d-block small">{{ $module->description }}</span>
											</label>
										</div>
									</div>
								@endforeach
							</div>
						</div>


						<div class="col-12 mt-3">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="userSubscribe" name="is_subscribed"
								       value="1" {{ old('is_subscribed') ? 'checked' : '' }}>
								<label class="form-check-label" for="userSubscribe">
									Subscribe to product updates and newsletters
								</label>
							</div>
						</div>

						<div class="col-12 mt-2">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="termsConditions"
								       name="terms_accepted" required>
								<label class="form-check-label" for="termsConditions">
									I have read and agree to the <a href="" target="_blank">Terms of
									                                                        Service</a>
									and <a href="" target="_blank">Privacy Policy</a>
								</label>
								@error('terms_accepted')
								<div class="invalid-feedback d-block">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="col-12 mt-4">
							<div class="d-grid">
								<button type="submit" class="btn btn-primary py-2 fw-bold">
									<i class='bx bx-user me-1'></i>Create My Account
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-guest-layout>