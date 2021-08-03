@component('mail::message')
# Ellenöző lap készült a {{ $checkSheet->vehicle_name}} jármnűvéhez.

Köszönettel,<br>
{{ config('app.name') }}
@endcomponent
