<?php
/**
 *Template Name: Frontpage
 *
 * @package OnePress
 */

get_header(); ?>

<div id="content" class="site-content">
    <main id="main" class="site-main" role="main">


        <!--<button> Podcast </button>-->


        <h3 class="podcast_grid">Nyeste Podcasts</h3>

        <template id="podcast_template">
            <article class="cursor">
                <img src="" alt="">
                <h2 class="pod-title podcast_h2"></h2>
            </article>
        </template>

        <section id="podcastcontainernye"> </section>


    </main><!-- #main -->
</div><!-- #content -->
<script>
    const podcastsnyeUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/podcasts?per_page=100";
    async function getJson() {

        const data3 = await fetch(podcastsnyeUrl);
        podcasts = await data3.json();
        console.log("podcasts");

        visPodcastsNye();
    }


    function visPodcastsNye() {
        console.log("visPodcasts");

        let temp = document.querySelector("#podcast_template");
        let container = document.querySelector("#podcastcontainernye");
        /*container.innerHTML = "";*/
        podcasts.forEach(podcast => {
            /*  if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {*/

            let klon = temp.cloneNode(true).content;
            klon.querySelector("img").src = podcast.billede.guid;
            klon.querySelector("h2").innerHTML = podcast.title.rendered;

            klon.querySelector("article").addEventListener("click", () => {
                location.href = podcast.link;


            })
            container.appendChild(klon);
            /*}*/
        })


    }

    getJson();

</script>
<?php get_footer(); ?>
