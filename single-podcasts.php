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
        <article>
            <div class="podcast_showcase">
                <div class="podcast_billede">
                    <img src="" alt="">
                </div>
                <div class="podcast_overskrift">
                    <h2></h2>
                    <br>
                    <h3>Beskrivelse:</h3>
                    <p class="pod_beskrivelse"></p>
                    <br>
                    <p class="vaerter"></p>

                </div>
            </div>
        </article>
        <h3 class="streaminglinks">Du kan også lytte her: Spotify - Apple - Podimo - Google - Streaker</h3>

        <section id="afsnitter">
            <template>
                <article class="afsnitter_section">
                    <div class="afsnitter_billede">
                        <img src="" alt="" class="episode_filter">
                    </div>
                    <div class="afsnitter_indhold">
                        <h3></h3>
                        <h4></h4>
                        <p class="afsnit_nr"></p>
                        <!--<p class="varighed"></p>
                        <p class="dato"></p>-->
                        <a href="">Læs mere</a>

                        <button class="btn btn-danger btn-lg loud_afspiller">Afspil</button>

                    </div>
                </article>
            </template>

        </section>


        <section id="podcastcontainer">
            <template>
                <article>
                    <img src="" alt="">
                    <h2 class="pod-title"></h2>
                </article>
            </template>
        </section>

    </main><!-- #main -->


    <script>
        let podcast;
        let afsnitter;
        let aktuelpodcast = <?php echo get_the_ID() ?>;


        const dbUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/podcasts/" + aktuelpodcast;
        const afsnitterUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/afsnitter?per_page=100";


        const podcastsUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/podcasts?per_page=100";

        const container = document.querySelector("#afsnitter");

        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();

            const data2 = await fetch(afsnitterUrl);
            afsnitter = await data2.json();
            console.log("afsnitter: ", afsnitter);


            const data3 = await fetch(podcastsUrl);
            podcasts = await data3.json();
            console.log("podcasts");



            visPodcast();
            visAfsnitter();
            visPodcasts();

        }

        function visPodcast() {
            console.log("visPodcast");
            console.log("podcast.title.rendered :", podcast.title.rendered);
            document.querySelector("h2").innerHTML = podcast.title.rendered;
            console.log("podcast.billede.guid :", podcast.billede.guid);
            document.querySelector(".podcast_billede img").src = podcast.billede.guid;
            document.querySelector(".pod_beskrivelse").innerHTML = podcast.podcast_beskrivelse;
            document.querySelector(".vaerter").innerHTML = "Værter: " + podcast.vaerter;
        }


        function visAfsnitter() {
            console.log("visAfsnitter");
            let temp = document.querySelector("template");
            afsnitter.forEach(afsnitter => {
                console.log("loop id :", aktuelpodcast);
                if (afsnitter.horer_til_podcast == aktuelpodcast) {
                    console.log("loop kører id :", aktuelpodcast);
                    let klon = temp.cloneNode(true).content;

                    klon.querySelector("img").src = afsnitter.billede.guid;
                    klon.querySelector("h3").innerHTML = afsnitter.title.rendered;

                    klon.querySelector("h4").innerHTML = afsnitter.afsnit_navn;
                    klon.querySelector(".afsnit_nr").innerHTML = afsnitter.afsnit_nr;
                    /*klon.querySelector(".varighed").innerHTML = afsnitter.varighed;
                    klon.querySelector(".dato").innerHTML = afsnitter.dato;*/

                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = afsnitter.link;
                    })

                    klon.querySelector("a").href = afsnitter.link;
                    console.log("afsnitter", afsnitter.link);
                    container.appendChild(klon);

                }
            })
        }



        function visPodcasts() {
            console.log("visPodcasts");

        }

        getJson();

    </script>



</div><!-- #content -->

<?php get_footer(); ?>
