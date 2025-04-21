<style>/* Pricing section enhancements */
    .pricing-item {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: relative;
        height: 100%;
    }

    .pricing-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .pricing-item h3 {
        background: linear-gradient(45deg, #4e73df, #2e59d9);
        color: white;
        padding: 20px;
        margin: 0;
        font-weight: 600;
    }

    .pricing-item .description {
        padding: 15px;
        color: #6c757d;
    }

    .pricing-item h4 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 15px 0;
    }

    .pricing-item h4 sup {
        font-size: 1.5rem;
        top: -0.5em;
    }

    .pricing-item h4 span {
        font-size: 1rem;
        color: #6c757d;
        font-weight: normal;
    }

    .pricing-item ul {
        padding: 0 20px 20px;
        list-style: none;
    }

    .pricing-item ul li {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .pricing-item ul li i {
        margin-right: 8px;
        font-size: 1rem;
    }

    .pricing-item ul li i.bi-check {
        color: #28a745;
    }

    .pricing-item ul li i.bi-x {
        color: #dc3545;
    }

    .confirmationBtn {
        transition: all 0.3s ease;
        margin: 15px auto;
        display: block;
        width: 80%;
        padding: 10px;
        font-weight: 600;
    }

    /* Button animation */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
        }
    }

    .pulse-animation {
        animation: pulse 1.5s infinite;
    }

    /* Modal styles */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(45deg, #4e73df, #2e59d9);
        color: white;
        border-bottom: none;
    }

    .modal-title {
        font-weight: 600;
    }

    /* Plan details in modal */
    .plan-details {
        text-align: center;
        padding: 20px;
    }

    .plan-header {
        margin-bottom: 15px;
    }

    .plan-header i {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .plan-pricing {
        margin: 20px 0;
    }

    .plan-pricing .currency {
        font-size: 1.5rem;
        vertical-align: top;
        position: relative;
        top: 0.5rem;
    }

    .plan-pricing .amount {
        font-size: 3rem;
        font-weight: 700;
    }

    .plan-pricing .period {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Loader styles */
    .loader-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 150px;
    }

    .loader-spinner {
        display: flex;
        gap: 10px;
    }

    .loader-spinner .spinner-grow {
        width: 1rem;
        height: 1rem;
    }

    .loader-text {
        color: #6c757d;
        font-size: 1rem;
    }

    /* Error message */
    .error-message {
        text-align: center;
        padding: 20px;
    }

    .error-message i {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    /* Stripe Elements */
    #card-element {
        background-color: white;
        padding: 16px;
        border-radius: 4px;
        border: 1px solid #e0e0e0;
        transition: all 0.2s ease;
        margin-bottom: 15px;
    }

    #card-element:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    #card-error {
        color: #dc3545;
        text-align: center;
        margin-top: 10px;
        display: none;
        padding: 8px;
        background-color: rgba(220, 53, 69, 0.1);
        border-radius: 4px;
    }

    /* Success Animation */
    .success-animation {
        text-align: center;
        padding: 30px 0;
    }

    .checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #4bb71b;
        stroke-miterlimit: 10;
        animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
    }

    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #4bb71b;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0 0 0 30px #4bb71b;
        }
    }

    @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }</style>

<section id="pricing" class="pricing section">

	<!-- Section Title -->
	<div class="container section-title" data-aos="fade-up">
		<h2>Pricing</h2>
		<div><span>Check Our</span> <span class="description-title">Pricing</span></div>
	</div><!-- End Section Title -->

	<div class="container">

		<div class="row gy-4">

			@php
				$currentSubs = app('subscription_helper')->getCurrentSubscription() ?? '';
			@endphp

			@foreach($plans as $key=>$plan)

				<div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
					<div class="pricing-item">

						<h3>{{$plan->name}}</h3>
						<h3>{{$plan->amount}}</h3>
						@if($currentSubs && $currentSubs->subscription_plan_price_id == $plan->stripe_price_id)
								@if($currentSubs && $currentSubs->plan_interval === 'lifetime')
									<button type="button" class="btn btn-danger">
										Subscribed
									</button>
								@else
									<button type="button"
									        class="btn btn-danger cancelSubscriptionBtn"
									        data-id="{{$currentSubs->id}}"
									        data-bs-toggle="modal"
									        data-bs-target="#cancelSubscriptionModal">
										Cancel Subscription
									</button>
								@endif
						@else
							<p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex
							                       strater</p>
							<h4><sup>$</sup>{{$plan->amount}}<span> / month</span></h4>
							<button type="button"
							        class="btn btn-primary confirmationBtn
							         "
							        data-bs-toggle="modal"
							        data-bs-target="#subscriptionModal"
							        data-id="{{$plan->id}}"
							        @if($currentSubs && $currentSubs->plan_interval === 'lifetime')  disabled @endif
							>
								Subscribe
							</button>

						@endif


						<p class="text-center small">No credit card required</p>
						<ul>
							<li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
							<li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
							<li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
							<li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span>
							</li>
							<li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis
   hendrerit</span></li>
							<li class="na"><i class="bi bi-x"></i> <span>Voluptate id voluptas qui sed aperiam
   rerum</span></li>
							<li class="na"><i class="bi bi-x"></i> <span>Iure nihil dolores recusandae odit
   voluptatibus</span></li>
						</ul>
					</div>
				</div>
			@endforeach

			<!-- End Pricing Item -->

		</div>

	</div>

</section>

{{-- Subscription Modal --}}
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="subscriptionModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="confirmation-data">
					<i class="fa fa-circle-o-notch fa-spin text-center" style="font-size:48px"></i>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="continueBuyPlan">Continue</button>
			</div>
		</div>
	</div>
</div>


{{-- Stripe Modal Plan --}}
<div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="stripeModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="stripeModalLabel">
					Buy Subscription
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="planId" id="planId">

				{{-- Stripe Card Element --}}
				<div id="card-element"></div>
				<div id="card-error" role="alert" style="color: red;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="buyPlanSubmit">Buy Plan</button>
			</div>
		</div>
	</div>
</div>
{{-- Cancel Subscription Modal --}}
<div class="modal fade" id="cancelSubscriptionModal" tabindex="-1" aria-labelledby="cancelSubscriptionModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cancelSubscriptionModalLabel">Cancel Subscription</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="text-center mb-4">
					<i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 48px;"></i>
					<h4 class="mt-3">Are you sure?</h4>
					<p class="text-muted">You're about to cancel your subscription. This action cannot be undone.</p>
				</div>
				<input type="hidden" id="subscriptionId">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Subscription</button>
				<button type="button" class="btn btn-danger" id="confirmCancelSubscription">
					<span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
					Confirm Cancellation
				</button>
			</div>
		</div>
	</div>
</div>

@push('script')
	<script src="http://js.stripe.com/v3/"></script>

	<script>
        $(document).ready(function () {
// Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

// Global variables
            let loadingTimer;

// Enhance confirmation button with animation
            $('.confirmationBtn').on('mouseenter', function () {
                $(this).addClass('pulse-animation');
            }).on('mouseleave', function () {
                $(this).removeClass('pulse-animation');
            });

// Handle plan selection
            $('.confirmationBtn').click(function () {
                const planId = $(this).data('id');
                const planName = $(this).closest('.pricing-item').find('h3').text();

// Set modal title
                $('#subscriptionModalLabel').text('Subscribe to ' + planName);

// Show loading animation
                showLoader('.confirmation-data');

                $("#planId").val(planId);

// Ajax request with improved error handling
                $.ajax({
                    type: "POST",
                    url: "{{route('getPlanDetails')}}",
                    data: {id: planId, _token: "{{csrf_token()}}"},
                    success: function (response) {
                        hideLoader();

                        if (response.success) {
                            var data = response.data;

// Enhanced HTML with better formatting
                            var html = `
<div class="plan-details">
<div class="plan-header">
<i class="bi bi-check-circle-fill text-success"></i>
<h4>${data.name} Plan</h4>
</div>
<div class="plan-pricing">
<span class="currency">$</span>
<span class="amount">${data.amount}</span>
<span class="period">/ ${data.type === 2 ? 'one-time' : (data.type === 1 ? 'year' : 'month')}</span>
</div>
<div class="plan-features mt-3">
<p class="text-muted">You're about to start your free trial. No credit card required during trial period.</p>
</div>
</div>
`;

                            $('.confirmation-data').html(html);

// Animate the content appearing
                            $('.plan-details').hide().fadeIn(400);

                        } else if (response.error) {
                            showErrorMessage('.confirmation-data', response.error);
                        }
                    },
                    error: function (xhr) {
                        hideLoader();
                        showErrorMessage('.confirmation-data', 'An error occurred. Please try again later.');
                    }
                });
            });

// Continue button action
            $('#continueBuyPlan').click(function () {
// Slide transition between modals
                $('#subscriptionModal').modal('hide');
                setTimeout(() => {
                    $('#stripeModal').modal('show');
                }, 500);
            });

// Initialize Stripe
            if (window.Stripe) {
                var stripe = Stripe("{{env('STRIPE_KEY')}}");
                var elements = stripe.elements();

// Custom styling for the card element
                var style = {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        },
                        ':-webkit-autofill': {
                            color: '#32325d',
                        },
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a',
                        ':-webkit-autofill': {
                            color: '#fa755a',
                        },
                    }
                };

                var card = elements.create('card', {
                    hidePostalCode: true,
                    style: style
                });

// Mount the card element
                card.mount('#card-element');

// Show card errors
                card.addEventListener('change', function (event) {
                    var displayError = document.getElementById('card-error');

                    if (event.error) {
                        $(displayError).html(`<i class="bi bi-exclamation-triangle-fill me-2"></i>${event.error.message}`).fadeIn();
                    } else {
                        $(displayError).fadeOut(300, function () {
                            $(this).html('');
                        });
                    }
                });

// Handle form submission
                var submitBtn = document.getElementById("buyPlanSubmit");
                var submitBtnText = submitBtn.innerHTML;

                submitBtn.addEventListener('click', function (e) {
// Disable button and show loading
                    $(submitBtn).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...').prop('disabled', true);

                    stripe.createToken(card).then(function (res) {
                        if (res.error) {
// Show error and reset button
                            var errorElement = document.getElementById('card-error');
                            $(errorElement).html(`<i class="bi bi-exclamation-triangle-fill me-2"></i>${res.error.message}`).fadeIn();
                            $(submitBtn).html(submitBtnText).prop('disabled', false);
                        } else {
// Process the payment
                            createSubscription(res.token);
                        }
                    });
                });
            }

// Helper function to create subscription
            function createSubscription(token) {
                var plan_id = $("#planId").val();

                $.ajax({
                    url: "{{route('createSubscription')}}",
                    type: "POST",
                    data: {plan_id, data: token, _token: "{{csrf_token()}}"},
                    success: function (res) {
// Reset button state
                        $("#buyPlanSubmit").html(submitBtnText).prop('disabled', false);

                        if (res.success) {
// Show success message with animation
                            $('#stripeModal .modal-body').html(`
<div class="success-animation">
<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
</svg>
<h4 class="text-center mt-4">Subscription Successful!</h4>
<p class="text-center">${res.msg}</p>
</div>
`);

// Change footer buttons
                            $('#stripeModal .modal-footer').html(`
<button type="button" class="btn btn-success" onclick="window.location.reload()">Continue to Dashboard</button>
`);

                        } else {
// Show error message
                            $('#card-error').html(`<i class="bi bi-exclamation-triangle-fill me-2"></i>Something went wrong. Please try again.`).fadeIn();
                        }
                    },
                    error: function (xhr) {
// Reset button state
                        $("#buyPlanSubmit").html(submitBtnText).prop('disabled', false);

// Parse error message
                        let errorMsg = 'An error occurred. Please try again.';
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.error) errorMsg = response.error;
                        } catch (e) {
                        }

// Show error message
                        $('#card-error').html(`<i class="bi bi-exclamation-triangle-fill me-2"></i>${errorMsg}`).fadeIn();
                    }
                });
            }

// Helper function to show animated loader
            function showLoader(selector) {
                $(selector).html(`
<div class="loader-container">
<div class="loader-spinner">
<div class="spinner-grow text-primary" role="status">
<span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
<span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
<span class="visually-hidden">Loading...</span>
</div>
</div>
<p class="loader-text mt-3">Loading plan details...</p>
</div>
`);

// Start animated text
                let loadingText = 'Loading plan details';
                let dots = 0;

                loadingTimer = setInterval(() => {
                    dots = (dots + 1) % 4;
                    let text = loadingText + '.'.repeat(dots);
                    $('.loader-text').text(text);
                }, 500);
            }

// Helper function to hide loader
            function hideLoader() {
                clearInterval(loadingTimer);
            }

// Helper function to show error message
            function showErrorMessage(selector, message) {
                $(selector).html(`
<div class="error-message">
<i class="bi bi-exclamation-circle-fill text-danger"></i>
<p>${message}</p>
<button class="btn btn-outline-secondary btn-sm mt-2" onclick="$('#subscriptionModal').modal('hide')">Close</button>
</div>
`);
            }
        });
	</script>
	<script>
        // Handle subscription cancellation
        $('.cancelSubscriptionBtn').click(function() {
            const subscriptionId = $(this).data('id');
            $('#subscriptionId').val(subscriptionId);
        });

        $('#confirmCancelSubscription').click(function() {
            const subscriptionId = $('#subscriptionId').val();
            const btn = $(this);
            const spinner = btn.find('.spinner-border');

            // Disable button and show spinner
            btn.prop('disabled', true);
            spinner.removeClass('d-none');

            // Send cancellation request
            $.ajax({
                type: "POST",
                url: "{{route('cancelSubscription')}}", // You'll need to define this route
                data: {
                    subscription_id: subscriptionId,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    // Reset button state
                    btn.prop('disabled', false);
                    spinner.addClass('d-none');

                    if (response.success) {
                        // Show success message
                        $('#cancelSubscriptionModal .modal-body').html(`
                            <div class="success-animation">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>
                                <h4 class="text-center mt-4">Subscription Cancelled</h4>
                                <p class="text-center">${response.msg}</p>
                            </div>
                        `);

                        // Change footer buttons
                        $('#cancelSubscriptionModal .modal-footer').html(`
                            <button type="button" class="btn btn-primary" onclick="window.location.reload()">
                                Continue to Dashboard
                            </button>
                        `);
                    } else {
                        // Show error message
                        alert('Something went wrong. Please try again.');
                    }
                },
                error: function(xhr) {
                    // Reset button state
                    btn.prop('disabled', false);
                    spinner.addClass('d-none');

                    // Parse error message
                    let errorMsg = 'An error occurred. Please try again.';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.error) errorMsg = response.error;
                    } catch (e) {}

                    // Show error message
                    alert(errorMsg);
                }
            });
        });
	</script>
@endpush
