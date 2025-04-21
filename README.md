Using FlatPicker Guidance :
## Basic Template
    <input type="text" data-datepicker>
##Custom format:

    <input type="text" data-datepicker data-format="d/m/Y">

## Date range with min/max dates:
    <input type="text" data-daterange data-min-date="today" data-max-date="+30">
## Time picker (24-hour):

    <input type="text" data-timepicker data-time24hr="true">

## Inline calendar with specific enabled dates:
    <input type="text" data-datepicker data-inline="true" 
       data-enable='["2024-01-01", "2024-01-15", "2024-02-01"]'>
## DateTime picker with custom change handler:
    <input type="text" data-datetime data-on-change="handleDateChange">
## Specific days disabled:
    <input type="text" data-datepicker 
       data-disable='["2024-12-25", "2024-12-26", "2024-12-31"]'>
## Week numbers and custom first day:
    <input type="text" data-datepicker data-week-numbers="true" data-first-day-of-week="1">
