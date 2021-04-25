<?php
/**
 *Template Name: Frontpage
 *
 * @package OnePress
 */

get_header(); ?>

	<div id="content" class="site-content">
		<main id="main" class="site-main" role="main">

           <article>
            <img src="" alt="" class="podcast_billede">
            <h2></h2>
        </article>

        <section id="afsnitter">
            <template>
                <article>
                    <div>
                        <img src="" alt="">
                    </div>
                    <div>
                        <h2></h2>
                        <h3></h3>
                        <p class="afsnit_nr"></p>
                        <p class="varighed"></p>
                        <p class="dato"></p>
                        <a href="">Læs mere</a>

                    </div>
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


        const container = document.querySelector("#afsnitter");

        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();

            const data2 = await fetch(afsnitterUrl);
            afsnitter = await data2.json();
            console.log("afsnitter: ", afsnitter);


            visPodcasts();
            visAfsnitter();

        }

        function visPodcasts(){
            console.log("visPodcasts");
            console.log("podcast.title.rendered :", podcast.title.rendered);
            document.querySelector("h2").innerHTML = podcast.title.rendered;
            console.log("podcast.billede.guid :", podcast.billede.guid);
            document.querySelector(".podcast_billede").src = podcast.billede.guid;
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
                    klon.querySelector("h2").innerHTML = afsnitter.title.rendered;

                    klon.querySelector("h3").innerHTML = afsnitter.afsnit_navn;
                    klon.querySelector(".afsnit_nr").innerHTML = afsnitter.afsnit_nr;
                    klon.querySelector(".varighed").innerHTML = afsnitter.varighed;
                    klon.querySelector(".dato").innerHTML = afsnitter.dato;

                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = afsnitter.link;
                    })

                    klon.querySelector("a").href = afsnitter.link;
                    console.log("afsnitter", afsnitter.link);
                    container.appendChild(klon);

                }
            })
        }

        getJson();



    </script>



	</div><!-- #content -->

<?php get_footer(); ?>
