<?php
get_header();
$search_query = isset($_GET['search-title']) ? sanitize_text_field( $_GET['search-title'] ) : '';
$movies  = get_movies($search_query);
?>
<div class="container-fluid">
<?php
    if (!empty($search_query)) {
        echo "<h2>Search results for: $search_query</h2>";
    } else {
        echo "<h1 class='display-4 my-3 text-center'>Movie List</h1>";
    }
?>

    <div class="row justify-content-center pb-4">
        <div class="col-sm-4">
            <form class="input-group" action="#" method="GET">
                <input type="search" name="search-title" class="form-control">
                <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <div class="row" id="movies-container">
        
        <?php 

            foreach($movies as $movie):
            $genres = explode('-',$movie->genres);
        ?>
        <div class="col-xxl-3 col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="movie">
                        <div class="poster">
                            <img src="<?=get_stylesheet_directory_uri()?>/movies/<?=$movie->poster_path?>" alt="movie">
                        </div>
                        <div class="info">
                            <h2 class="h6">
                               <?= $movie->title?>
                            </h2>
                            <p class="mb-1" title="Popularity">
                                <i class="fa fa-fire-flame-curved"></i>
                                <span><?= $movie->popularity?></span>
                            </p>
                            <p class="mb-1" title="Release Date">
                                <i class="fa fa-calendar-alt"></i>
                                <span><?= $movie->release_date?></span>
                            </p>
                            <p class="mb-1" title="Runtime">
                                <i class="fa fa-clock"></i>
                                <span><?= $movie->runtime?></span> min
                            </p>
                            <p class="mb-1" title="Vote Average">
                                <i class="far fa-star"></i>
                                <span><?= $movie->vote_average?></span>
                            </p>
                            <div class="pt-2 d-flex flex-wrap gap-2">
                                <?php foreach($genres  as $genre):?>
                                    <div class="genre"><?=$genre?></div> 
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
<?php
get_footer();
?>