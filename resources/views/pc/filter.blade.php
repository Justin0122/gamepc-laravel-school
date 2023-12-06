<div class="filter">
    @php
        $parttypes = \App\Models\Parttype::all();
        foreach ($parttypes as $parttype) {
            $active = Request::is('parttype/' . $parttype->Name) ? 'active' : '';
            echo '<li id="nav-item" class="nav-item ' . $active . '">
            <a class="nav-link" href="' . route('parttype', $parttype->Name) . '"><i class=""></i><span>' . $parttype->Name . '</span></a></li>';
    }
    @endphp
</div>
