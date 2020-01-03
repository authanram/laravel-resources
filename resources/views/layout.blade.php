<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link
        crossorigin="anonymous"
        href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.4/tailwind.min.css"
        integrity="sha256-bCQF5OufWlWM/MW9mCb/eDibvff1W8BNq9ZK69C8FSI="
        rel="stylesheet"
    />

    @yield ('styles')

</head>

<body class="{{ $action->theme('resources.layout.body') }}">

    <div class="{{ $action->theme('resources.breadcrumbs.container') }}">

        @yield ('breadcrumbs')

    </div>

    @yield ('flash')

    <div class="{{ $action->theme('resources.card') }}">

        @yield ('content')

    </div>

    @yield ('meta')

    @yield ('pagination')

    @yield ('scripts')

</body>

</html>
