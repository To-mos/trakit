        	<script>
                //fire up lightbox
                $(function() {
                    $('.thumbnail a').lightBox();
                });
            </script>
            <div id="wrapper">
                <p align="center"><img src="<?= base_url(); ?>assets/img/logos/<?= $logo; ?>"/></p>
                <?php
                //die(var_dump($results));
                $current_year="";
                foreach($results as $item) 
                {
                    $gal_year = $item['year'];
                        if($gal_year != $current_year)
                        {
                            $current_year = $gal_year;
                            echo "<div class=\"rssdate\">".$current_year."</div>";
                        }
                ?>
                <div class="thumbnail">
                    <a href="<?= $item['url']; ?>">
                        <img src="<?= $item['url']; ?>" alt="Image" border="0" />
                        <br />
                        <?= $item['title']; ?>
                    </a>
                </div>
                <?php
                }
                ?>
          	</div>