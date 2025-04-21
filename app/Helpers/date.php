<?php

use App\Helpers\StoreHelper;
use App\Services\AccountValidationService;
use Carbon\Carbon;

if (! function_exists('readableDate')) {
    /**
     * Format Date To m/d/Y Date Format
     */
    function readableDate($date): string
    {
        return Carbon::parse($date)->format('d M Y');
    }
}

if (! function_exists('readableDateTime')) {
    /**
     * Format Date To m/d/Y Date Format
     */
    function readableDateTime($date): string
    {
        return Carbon::parse($date)->format('d M Y h:i:a');
    }
}

if (! function_exists('getScheduleDateTime')) {
    /**
     * Format Date To m/d/Y Date Format
     *
     * @return string
     */
    function getScheduleDateTime($date)
    {
        if (strlen($date)) {
            return Carbon::parse($date)->format('Y-m-d h:i a');
        }
    }
}

// Human Readable Date Format
if (! function_exists('humanReadableDate')) {
    /**
     * Convert a given date to a human-readable format.
     * Example format: "Monday, 15th January 2025 10:30 AM"
     */
    function humanReadableDate(?string $date): ?string
    {
        try {
            if ($date) {
                return Carbon::parse($date)->format('l, jS F Y h:i A');
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }
}

if (! function_exists('differenceInDays')) {
    /**
     * Format Date To m/d/Y Date Format
     *
     * @param  $date
     */
    function differenceInDays($startdate, $endDate): string
    {
        return Carbon::parse($endDate)->diffInDays($startdate);
    }
}

if (! function_exists('calculateMonthDiff')) {
    /**
     * Format Date To m/d/Y Date Format
     */
    function calculateMonthDiff($date): string
    {
        return now()->diffInMonths($date);
        //        return Carbon::parse($date)->diffInMonths(now());
    }
}

if (! function_exists('getYearsList')) {
    function getYearsList()
    {
        $keys = array_merge(range(date('Y') + 5, 1966));
        $values = array_merge(range(date('Y') + 5, 1966));
        $choice = array_combine($keys, $values);

        return $choice;
    }
}

if (! function_exists('getMonthsList')) {
    function getMonthsList()
    {
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
    }
}

if (! function_exists('todayDBFormat')) {
    /**
     * Return Today Date in Database Preferred Format
     */
    function todayDBFormat(): string
    {
        return now()->format('Y-m-d');
    }
}

if (! function_exists('en2bnNumber')) {
    /**
     * Prepare the Column Name for Lables.
     */
    function en2bnNumber($number)
    {
        if ($number || $number == '0') {
            $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
            $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];

            $bn_number = str_replace($search_array, $replace_array, $number);

            return $bn_number;
        }
    }
}

if (! function_exists('en2bnDate')) {
    /**
     * Convert a English number to Bengali.
     */
    function en2bnDate($date)
    {
        if ($date) {
            $date = Carbon::parse($date)->format('d M Y');
        }

        // Convert numbers
        $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $bn_date = str_replace($search_array, $replace_array, $date);

        // Convert Short Week Day Names
        $search_array = ['Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu'];
        $replace_array = ['শুক্র', 'শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert Month Names
        $search_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $replace_array = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগষ্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert Short Month Names
        $search_array = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $replace_array = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগষ্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert AM-PM
        $search_array = ['am', 'pm', 'AM', 'PM'];
        $replace_array = ['পূর্বাহ্ন', 'অপরাহ্ন', 'পূর্বাহ্ন', 'অপরাহ্ন'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        return $bn_date;

    }

}

if (! function_exists('dateDifferenceBn')) {
    /**
     * Convert a English number to Bengali.
     */
    function dateDifferenceBn($from, $to = null)
    {
        if ($from) {
            $diff = Carbon::parse($to)->diff($from);

            return "$diff->y বছর $diff->m মাস";
        }
    }

}

if (! function_exists('readableDateFormat')) {
    /**
     * Format Date To m/d/Y Date Format
     */
    function readableDateFormat($date): string
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}

if (! function_exists('active_currency')) {
    function active_currency()
    {
        return StoreHelper::getActiveCurrency();
    }
}

if (! function_exists('transaction_create_button')) {
    /**
     * Check if transaction create button should be visible
     *
     * @param  int|null  $storeId  The store ID to validate
     * @return bool Whether the create button should be shown
     */
    function transaction_create_button()
    {
        // Get Store Ids

        //        $storeId = StoreHelper::getStores()->pluck('id')->toArray();

        // Get service from container
        $accountValidationService = app(AccountValidationService::class);

        // Validate the store account
        $validation = $accountValidationService->validateStoreAccount();

        // Return whether button should be visible
        return (bool) $validation['success'];
    }
}
