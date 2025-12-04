<div class="p-6">

    {{-- ===== CUSTOM CSS ===== --}}
    <style>
        .table-wrapper {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(140, 140, 140, 0.18);
            backdrop-filter: blur(6px);
        }

        .table-modern thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table-modern th {
            background: rgba(243, 244, 246, 0.85);
            font-weight: 600;
            letter-spacing: .3px;
        }

        .dark .table-modern th {
            background: rgba(31, 41, 55, 0.9);
        }

        .table-modern td {
            transition: background 0.18s ease;
        }

        .table-modern tr:hover td {
            background: rgba(229, 231, 235, 0.6);
        }

        .dark .table-modern tr:hover td {
            background: rgba(75, 85, 99, 0.6);
        }

        .user-icon {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            font-weight: 600;
        }

        .badge {
            padding: 4px 9px;
            font-size: 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.25);
            color: #15803d;
        }

        .dark .badge-success {
            background: rgba(34, 197, 94, 0.18);
            color: #4ade80;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.25);
            color: #b91c1c;
        }

        .dark .badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }

        .badge-neutral {
            background: rgba(107, 114, 128, 0.25);
            color: #374151;
        }

        .dark .badge-neutral {
            background: rgba(107, 114, 128, 0.15);
            color: #e5e7eb;
        }
    </style>


    {{-- ===== MAIN VIEW ===== --}}
    @if($record->users && $record->users->count() > 0)

        {{-- TITLE SECTION --}}
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
            Anggota Kelompok: {{ $record->name }}
        </h2>

        {{-- TABLE WRAPPER --}}
        <div class="table-wrapper shadow-md">
            <table class="w-full table-auto border-collapse table-modern">
                <thead>
                    <tr class="text-gray-700 dark:text-gray-300 text-sm">
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">No. Telepon</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">WA</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-800 dark:text-gray-200">
                    @foreach($record->users as $index => $user)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $index + 1 }}</td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 flex items-center justify-center rounded-full user-icon shadow">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>

                            <td class="px-4 py-3 font-mono">
                                {{ $user->phone_number }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($user->isActive)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($user->wa_verified)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-neutral">Belum</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- FOOTER --}}
        <div class="mt-3 text-sm flex justify-between text-gray-700 dark:text-gray-300">
            <p>Total anggota: <strong>{{ $record->users->count() }}</strong></p>
            <p>Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}</p>
        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="flex flex-col items-center justify-center p-10 border-2 border-dashed
                    border-gray-300 rounded-xl bg-white dark:bg-gray-800 dark:border-gray-600">

            <div class="h-16 w-16 flex items-center justify-center border-2 border-gray-400
                        rounded-full text-xl dark:border-gray-500 text-gray-500">
                0
            </div>

            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">
                Belum Ada Anggota
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Silakan tambahkan anggota ke kelompok ini.
            </p>

            <button class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                Tambah Anggota
            </button>
        </div>
    @endif

</div>
