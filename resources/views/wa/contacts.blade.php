<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Contact List</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Tambah Kontak -->
    <form action="{{ route('contacts.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
            <div class="col-md-3"><input type="text" name="phone" class="form-control" placeholder="Phone" required></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            <div class="col-md-3"><button type="submit" class="btn btn-primary">Add Contact</button></div>
        </div>
    </form>

    <!-- Tabel Kontak -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol untuk menghapus semua kontak -->
    <form action="{{ route('contacts.deleteAll') }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete All Contacts</button>
    </form>
</div>
</body>
</html>
