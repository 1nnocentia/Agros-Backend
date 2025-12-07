<div class="table-container">
    <table class="modern-table">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Status</th>
            <th>WA</th>
        </tr>
        </thead>

        <tbody>
        @foreach($members as $member)
            <tr>
                <td class="name-cell">{{ $member->name }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->status }}</td>
                <td>{{ $member->whatsapp ? 'Sudah' : 'Belum' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<style>
    .table-container {
        width: 100%;
        background: #111;
        border-radius: 6px;
        padding: 12px;
        color: white;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .modern-table thead tr {
        background: linear-gradient(90deg, #6165ff 0%, #8746ff 100%);
        color: white;
        border-radius: 4px;
    }

    .modern-table thead th {
        padding: 12px 14px;
        text-align: left;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .modern-table tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.1);
        transition: .2s ease;
    }

    .modern-table tbody td {
        padding: 12px 14px;
        color: rgba(255,255,255,0.85);
    }

    .name-cell {
        font-weight: 600;
        color: white;
    }

    .modern-table tbody tr:hover {
        background: rgba(255,255,255,0.06);
        cursor: pointer;
    }

</style>
