<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

get_header();

$layout = onepress_get_layout();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
do_action( 'onepress_page_before_content' );

?>
<div id="content" class="site-content">
    <?php onepress_breadcrumb(); ?>
    <div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">

        <template>
            <article>
                <img src="" alt="">
                <h2 class="pod-title"></h2>
            </article>
        </template>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">


                <section id="primary" class="content-area"></section>
                <nav id="filtrering"><button data-podcasts="alle" class="filter valgt">Alle</button></nav>

                <section id="podcastcontainer"></section>


            </main><!-- #main -->
        </div><!-- #primary -->
        <script>
            let podcasts;
            let categories;
            let filterPodcast = "alle";
            const dbUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/podcasts?per_page=100";

            const catUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/categories";


            async function getJson() {
                const data = await fetch(dbUrl);
                const catdata = await fetch(catUrl);
                podcasts = await data.json();
                categories = await catdata.json();
                visPodcasts();
                opretKnapper();

            }


            function opretKnapper() {

                categories.forEach(cat => {
                    document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
                })

                addEventListenerToButtons();

            }

            function addEventListenerToButtons() {
                document.querySelectorAll("#filtrering button").forEach(elm => {
                    elm.addEventListener("click", filtrering);
                })


            }

            function filtrering() {

                document.querySelector(".valgt").classList.remove("valgt");

                this.classList.add("valgt");

                filterPodcast = this.dataset.podcast;
                console.log(filterPodcast);

                visPodcasts();


            }

            function visPodcasts() {
                let temp = document.querySelector("template");
                let container = document.querySelector("#podcastcontainer")
                container.innerHTML = "";
                podcasts.forEach(podcast => {
                    if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {

                        let klon = temp.cloneNode(true).content;
                        klon.querySelector("img").src = podcast.billede.guid;
                        klon.querySelector("h2").innerHTML = podcast.title.rendered;

                        klon.querySelector("article").addEventListener("click", () => {
                            location.href = podcast.link;


                        })
                        container.appendChild(klon);
                    }
                })

            }

            getJson();

        </script>

    </div>
    <!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
