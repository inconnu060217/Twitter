            <div class="col-4">
                <div class='row'>
                    <div class="col-12">
                        <div class="row border-notop">
                            <div class='col-10 my-2'>
                                <h5>Messages</h5>
                            </div>
                            <div class="col-2 my-2">
                                <svg class='icons addmessages mr-1' viewBox="0 0 24 24">
                                    <g>
                                        <path d="M23.25 3.25h-2.425V.825c0-.414-.336-.75-.75-.75s-.75.336-.75.75V3.25H16.9c-.414 0-.75.336-.75.75s.336.75.75.75h2.425v2.425c0 .414.336.75.75.75s.75-.336.75-.75V4.75h2.425c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-3.175 6.876c-.414 0-.75.336-.75.75v8.078c0 .414-.337.75-.75.75H4.095c-.412 0-.75-.336-.75-.75V8.298l6.778 4.518c.368.246.79.37 1.213.37.422 0 .844-.124 1.212-.37l4.53-3.013c.336-.223.428-.676.204-1.012-.223-.332-.675-.425-1.012-.2l-4.53 3.014c-.246.162-.563.163-.808 0l-7.586-5.06V5.5c0-.414.337-.75.75-.75h9.094c.414 0 .75-.336.75-.75s-.336-.75-.75-.75H4.096c-1.24 0-2.25 1.01-2.25 2.25v13.455c0 1.24 1.01 2.25 2.25 2.25h14.48c1.24 0 2.25-1.01 2.25-2.25v-8.078c0-.415-.337-.75-.75-.75z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <form method="GET" class="col-12 form-inline border-notop sm-padding">
                        <button><i class="fas fa-search"></i></button>
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search">
                    </form>
                    <div class="border-notop col-12">
                        <?php
                        include_once("../controllers/getMessages.php");
                        if (isset($_GET['search'])) { ?>
                        <?php
                            $user = new SearchUser($_GET['search']);
                            $searchName = $user->getSearch();
                            var_dump($searchName);
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="d-flex flex-column align">
                    <h5>Aucun message n'est sélectionné.</h5>
                    <p>Choisissez-en un dans vos messages existants, ou commencez-en un nouveau.</p>
                    <div class='col-8 my-2'>
                        <button type="submit" class='btn tweet_btn' data-role='tweet'>Nouveau message</button>
                    </div>
                </div>
            </div>