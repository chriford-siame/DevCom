
@component('mail::message')
# New Property Matching Your Criteria

We have found a property that matches your selected criteria:

{{-- **Address:** {{ $name }} --}}
**Price:** { $property->price }
**Bedrooms:** { $property->bedrooms }
**Bathrooms:** { $property->bathrooms }

If you're interested or need more information, please contact us.

Thanks,<br>

{{ config('app.name') }}
@endcomponent
