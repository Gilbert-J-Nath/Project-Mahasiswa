@include('header')

<div class="container my-5">
    <!-- Pastikan row ini mencakup semua bagian konten -->
    <div class="row">
        <div class="col-12">
            <h2 class="text-center my-4">Data Mahasiswa</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-end mb-3">
        <a href="{{ route('tambah') }}" class="btn btn-success">Tambah Data</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th width="40%">Nama</th>
                        <th width="40%">Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $item)
                    <tr>
                        <td>{{ $item->nrp }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ route('edit', $item->nrp) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $item->nrp) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- Optional: Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

</body>
</html>
