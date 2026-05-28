@props([
    'title' => 'Data Table', 
    'headers' => [], 
    'addButton' => true, 
    'exportButton' => false,
    'exportRoute' => null,  // TAMBAH INI
    'addRoute' => '#', 
    'filterOptions' => [],
    'data' => null
])

<div class="table-container">
    <h5 class="table-title">{{ $title }}</h5>
    
    <div class="table-header">
        
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control search-input" placeholder="Search here...">
        </div>
        
        <div class="table-actions">
            @if(!empty($filterOptions))
            <div class="dropdown">
                <button class="btn dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown">
                    Tampilkan Semua
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item filter-item" href="#" data-filter="Semua">Semua</a></li>
                    @foreach($filterOptions as $option)
                        <li><a class="dropdown-item filter-item" href="#" data-filter="{{ $option }}">{{ $option }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($exportButton && $exportRoute)
            <a href="{{ $exportRoute }}" class="btn btn-export">
                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor Laporan
            </a>
            @endif

            @if($addButton)
            <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-lg"></i> Tambah Data
            </button>
            @endif
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table class="table custom-table mb-0">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th class="fw-bold text-dark">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
        @if (isset($footer))
        <div class="table-footer">
            {{ $footer }}
        </div>
    @endif
</div>
