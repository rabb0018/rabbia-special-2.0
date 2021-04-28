<?php
/**
 *Template Name: Frontpage
 *
 * @package OnePress
 */

get_header(); ?>

<div id="content" class="site-content">
    <main id="main" class="site-main" role="main">

        <h1 class="entry-title">Podcasts</h1>

        <section id="afsnit">

            <article>
                <div class="afsnit_grid">
                    <div>
                        <img src="" alt="" class="afsnit_billede">
                    </div>
                    <div class="enkelt_afsnit_indhold">
                        <h2 class="afsnit_h2"></h2>
                        <h3 class="afsnit_h3_2"></h3>
                        <button class="btn btn-danger btn-lg loud_afspiller">Afspil</button>
                        <br>

                        <p class="beskrivelsestekst afsnit_tekst"></p>

                        <br>
                        <p class="vaerter afsnit_tekst"></p>
                        <p class="medvirkende afsnit_tekst"></p>
                        <p class="redaktoer afsnit_tekst"></p>
                        <br>

                        <div class="grid_for_info">
                            <div class="column_1">
                                <p class="afsnit_nr afsnit_tekst"></p>
                            </div>
                            <div class="column_2">
                                <p class="varighed afsnit_tekst"></p>
                            </div>
                            <div class="column_3">
                                <p class="dato afsnit_tekst"></p>
                            </div>
                        </div>

                    </div>
                </div>
            </article>
            <h3 class="streaminglinks">Du kan også lytte her: Spotify - Apple - Podimo - Google - Streaker</h3>
        </section>



        <!--Grid til flere afsnit-->


        <template>
            <article class="afsnitter_section">
                <div class="afsnitter_billede">
                    <img src="" alt="" class="episode_filter">
                </div>
                <div class="afsnitter_indhold">
                    <h3 class="afsnit_h3"></h3>
                    <h4 class="afsnit_h4"></h4>
                    <p class="afsnit_nr afsnit_tekst"></p>
                    <!--<p class="varighed"></p>
                        <p class="dato"></p>-->
                    <a href="">Læs mere</a>

                    <button class="btn btn-danger btn-lg loud_afspiller">Afspil</button>

                </div>
            </article>
        </template>

        <section id="afsnitter"></section>


        <!--Grid til flere podcasts-->

        <h3 class="podcast_grid">Du kan måske også lide...</h3>

        <template id="podcast_template">
            <article>
                <img src="" alt="">
                <h2 class="pod-title podcast_h2"></h2>
            </article>
        </template>

        <section id="podcastcontainer"> </section>

    </main><!-- #main -->


    <script>
        let aktuelafsnit;

        const afsnitUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/afsnitter/" + <?php echo get_the_ID() ?>;

        const container = document.querySelector("#afsnit");

        async function getJson() {
            const data = await fetch(afsnitUrl);
            afsnit = await data.json();
            console.log("afsnit: ", afsnit);


            visAfsnit();

        }

        function visAfsnit() {
            console.log("visAfsnit");

            document.querySelector(".afsnit_billede").src = afsnit.billede.guid;

            document.querySelector("h2").innerHTML = afsnit.title.rendered;

            document.querySelector("h3").textContent = afsnit.afsnit_navn;

            /*document.querySelector(".loud_afspiller").textContent = afsnit.loud_afspiller;*/

            document.querySelector(".afsnit_nr").textContent = afsnit.afsnit_nr;
            document.querySelector(".varighed").textContent = "Tid: " + afsnit.varighed;
            document.querySelector(".dato").textContent = "Dato: " + afsnit.dato;
            document.querySelector(".beskrivelsestekst").textContent = afsnit.beskrivelsestekst;
            document.querySelector(".vaerter").textContent = "Værter: " + afsnit.vaerter;
            document.querySelector(".medvirkende").textContent = "Medvirkende: " + afsnit.medvirkende;
            document.querySelector(".redaktoer").textContent = "Redaktør: " + afsnit.redaktoer;


        }

        getJson();

    </script>



</div><!-- #content -->

<?php get_footer(); ?>
