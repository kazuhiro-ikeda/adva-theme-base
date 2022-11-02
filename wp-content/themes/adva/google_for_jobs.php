<!-- for Google for jobs-->
<?php
$gfj_title = get_field('gfj_title');
if (!empty($gfj_title)) :
?>
<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "JobPosting",
    "title": "<?php the_field("gfj_title", $post->ID); ?>",
    "description": "<?php the_field("gfj_description", $post->ID); ?>",
    "datePosted": "<?php echo get_the_date('Y-m-d'); ?>",
    "employmentType": "<?php the_field("gfj_employment", $post->ID); ?>",
    "hiringOrganization": {
        "@type": "Organization",
        "name": "<?php the_field("gfj_name", $post->ID); ?>",
        "sameAs": "<?php bloginfo('url'); ?>/"
    },
    "jobLocation": {
        "@type": "Place",
        "address": {
            "@type": "PostalAddress",
            "addressRegion": "<?php the_field("gfj_pref", $post->ID); ?>",
            "addressLocality": "<?php the_field("gfj_city", $post->ID); ?>",
            "addressCountry": "JP"
        }
    },
    "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "JPY",
        "value": {
            "@type": "QuantitativeValue",
            "value": <?php the_field("gfj_salary", $post->ID); ?>,
            "unitText": "<?php the_field("gfj_pay_per", $post->ID); ?>"
        }
    }
}
</script>

<?php else : ?>
<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "JobPosting",
    "title": "<?php the_field("job", $post->ID); ?>",
    "description": "<?php the_field("detail", $post->ID); ?>",
    "datePosted": "<?php echo get_the_date('Y-m-d'); ?>",
    "employmentType": "<?php the_field("style", $post->ID); ?>",
    "hiringOrganization": {
        "@type": "Organization",
        "name": "<?php the_title(); ?>",
        "sameAs": "<?php bloginfo('url'); ?>/"
    },
    "jobLocation": {
        "@type": "Place",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?php the_field("place", $post->ID); ?>",
            "addressCountry": "JP"
        }
    },
    "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "JPY",
        "value": {
            "@type": "QuantitativeValue",
            "value": "<?php the_field("salary", $post->ID); ?>",
            "unitText": "HOUR"
        }
    }
}
</script>

<?php endif; ?>