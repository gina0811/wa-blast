<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page / </span> Settings</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="{{ asset('assets/img/avatars/1.png') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                            />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        {{-- Notifikasi --}}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        @endif

                        @if (Session::has('success'))
                            <x-alert type="success" :message="Session::get('success')" />
                        @endif

                        {{-- Form --}}
                        <form method="POST" action="{{ route('settings.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-floating mb-3 col-sm-12 col-md-6">
                                    <input
                                        type="number"
                                        id="phoneNumber"
                                        name="number"
                                        class="form-control"
                                        value="{{ isset($setting_number->value) ? str_replace('62', '', $setting_number->value) : '' }}"
                                        placeholder="Masukkan nomor WhatsApp"
                                    />
                                    <label for="phoneNumber">Nomor WhatsApp (tanpa +62)</label>
                                </div>
                                <div class="form-floating mb-3 col-sm-12 col-md-6">
                                    <input
                                        class="form-control"
                                        value="{{ isset($setting_url->value) ? $setting_url->value : '' }}"
                                        type="text"
                                        name="url"
                                        id="url"
               
