@component('mail::message')
# {{ $data['subject'] ?? 'New Contact Message' }}

**Name:** {{ $data['name'] }}

**Email:** {{ $data['email'] }}

**Message:**
{{ $data['message'] }}

@endcomponent
