<div class="gallery-container">
    @php
        $exists = false;
        if (!file_exists('product_images/'.$part[0]['Name'].'.png')) {
        echo '<img class="productImage" src="'.asset('img/placeholder.png').'" alt="placeholder of '.$part[0]['Name'].'" id="main-image">';
    }
    else{
        echo '<img class="productImage" src="'.asset('product_images/'.$part[0]['Name'].'.png').'" alt="'.$part[0]['Name'].'" id="main-image">';
    }
    @endphp

    @php $count = count(glob("product_images/".$part[0]['Name']."*"));
    if ($count > 1){ @endphp

    <div class="thumbnail-container">
        @php
            $i = 1;
            if ($exists != false){
                echo '<img class="thumbnail" src="'.asset('img/placeholder.png').'" alt="placeholder of '.$part[0]['Name'].'">';
            } else {
                echo '<img class="thumbnail" src="'.asset('product_images/'.$part[0]['Name'].'.png').'" alt="'.$part[0]['Name'].'">';
                while ($i < $count) {
                    echo '<img class="thumbnail" src="'.asset('product_images/'.$part[0]['Name'].' ('.$i.').png').'" alt="'.$part[0]['Name'].' ('.$i.')">';
                    $i++;
                }
            }
        @endphp
    </div>
    @php } @endphp
</div>

