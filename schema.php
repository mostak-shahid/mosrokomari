<?php 
global $mosrokomari_options; 
$logo_url = $mosrokomari_options['logo']['url'];
$contact_phone = @$mosrokomari_options['contact-phone'][0];
$contact_email = @$mosrokomari_options['contact-email'][0];
$contact_social = @$mosrokomari_options['contact-social'];
if ($contact_social) :
    foreach ($contact_social as $social) :
        $social_links[$social['title']] = $social['link_url'];
    endforeach;
endif;
if (@$social_links) $array = array_filter(array_values($social_links));

$schema_option = @$mosrokomari_options['schema-option'];
$schema_street = @$mosrokomari_options['schema-street'];
$schema_locality = @$mosrokomari_options['schema-locality'];
$schema_region = @$mosrokomari_options['schema-region'];
$schema_postal = @$mosrokomari_options['schema-postal'];
$schema_slides = @$mosrokomari_options['schema-slides'];
$snippets_option = @$mosrokomari_options['snippets-option'];
$snippets_name = @$mosrokomari_options['snippets-name'];
$snippets_value = @$mosrokomari_options['snippets-value'];
$snippets_count = @$mosrokomari_options['snippets-count'];
?>
<?php if($schema_option) : ?>
    <!--Common-->
    <script type="application/ld+json">
        {
            "@context": "http://schema.org","@type": "Organization","url": "<?php echo get_home_url(); ?>","logo": "<?php echo $logo_url?>"<?php if ($social_links) : ?>,"sameAs" : <?php echo json_encode($array, JSON_UNESCAPED_SLASHES) ?><?php endif; ?>
        }
    </script>
    <script type="application/ld+json">
        { 
            "@context": "http://schema.org",
            "@type": "WebSite", 
            "url": "<?php echo get_home_url(); ?>", 
            "potentialAction": {
                "@type": "SearchAction", 
                "target": "<?php echo get_home_url(); ?>/?s={search_term}", "query-input": "required name=search_term" 
            } 
        }
    </script>



    <?php 
    if($schema_slides) :
        foreach ($schema_slides as $slide) : 
            /*$address = $slide['description'];
            $slices = explode(",",$address);*/
            if ($slide['url'] AND $slide['title']) :
            ?>
            <script type="application/ld+json">
                { 
                    "@context": "http://schema.org",
                    "@type": "<?php echo $slide['url'] ?>",
                    "url": "<?php echo home_url();?>",
                    "image": "<?php echo $logo_url?>",
                    "name": "<?php echo $slide['title'] ?>", 
                    "priceRange": "$$", 
                    "telephone": "<?php echo $contact_phone; ?>", 
                    "email": "<?php echo $contact_email; ?>", 
                    "address":
                    {
                        "@type":"PostalAddress",
                        "streetAddress":"<?php echo $schema_street ?>",
                        "addressLocality":"<?php echo $schema_locality ?>",
                        "addressRegion":"<?php echo $schema_region ?>",
                        "postalCode":"<?php echo $schema_postal ?>"
                    }
                }

            </script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<?php if ($snippets_option) : ?>
    <script type="application/ld+json">
    { 
        "@context": "http://schema.org",
        "@type": "Product",
        "name": "<?php echo $snippets_name ?>",//Primary Keyword
        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "<?php echo $snippets_value ?>",//Google review rating
            "reviewCount": "<?php echo $snippets_count ?>"//Google review count
        }
    }
    </script>
<?php endif; ?>