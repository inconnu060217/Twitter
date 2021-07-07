<!-- Ici mettre la view de recherche ? -->
<div class='col-12 my-2'>
    <form class='from-inline search_form' action='search.php' method='get'>
        <input class="form-control" type="text" placeholder="Recherche Twitter" name='q'>
        <svg  class='search_icon' xmlns="http://www.w3.org/2000/svg" height='24' width='24' xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.005 512.005" style="enable-background:new 0 0 512.005 512.005;" xml:space="preserve">
            <g>
                <g>
                    <path d="M505.749,475.587l-145.6-145.6c28.203-34.837,45.184-79.104,45.184-127.317c0-111.744-90.923-202.667-202.667-202.667    S0,90.925,0,202.669s90.923,202.667,202.667,202.667c48.213,0,92.48-16.981,127.317-45.184l145.6,145.6    c4.16,4.16,9.621,6.251,15.083,6.251s10.923-2.091,15.083-6.251C514.091,497.411,514.091,483.928,505.749,475.587z     M202.667,362.669c-88.235,0-160-71.765-160-160s71.765-160,160-160s160,71.765,160,160S290.901,362.669,202.667,362.669z"/>
                </g>
            </g>
        </svg>
    </form>
</div>
<!-- Ici mettre la view de connecter/pas connecter ? -->
<?php 
    if (!isset($_SESSION['username'])) {
?>
<div class='col-12 my-2 border-all  p-2'>
    <h5 class='mb-3'>Nouveau sur Twitter</h5>
    <button type='button' class='btn-light btn-rounded' style='width: 100%;'>S'inscrire</button>
</div>
<?php 
    }
?>