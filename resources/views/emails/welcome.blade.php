Hello {{ $user->name }}

Thanks.... Please verify your email with this link {{ route('verify', $user->verification_token) }}
