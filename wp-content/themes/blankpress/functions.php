<?php

// **********************************************
// Include jQuery on all pages
// **********************************************

    if(!function_exists('PG_LoadJquery')) {
        function PG_LoadJquery() {
            if(!is_admin()) {
                wp_enqueue_script('jquery');
            }
        }
        add_action('init', 'PG_LoadJquery');
    }

// **********************************************
// Generate custom post type labels array
// **********************************************

    if(!function_exists('PG_CustomPostTypeLabels')) {
        function PG_CustomPostTypeLabels($sSingular, $sPlural = null) {

            if(!$sPlural) {
                $sPlural = $sSingular . 's';
            }

            $aLabels = array(
                'name'              => $sPlural,
                'singular_name'     => $sSingular,
                'search_items'      => 'Search ' . $sPlural,
                'all_items'         => 'All ' . $sPlural,
                'parent_item'       => 'Parent ' . $sSingular,
                'parent_item_colon' => 'Parent ' . $sSingular . ':',
                'edit_item'         => 'Edit ' . $sSingular,
                'update_item'       => 'Update ' . $sSingular,
                'add_new_item'      => 'Add New ' . $sSingular,
                'new_item_name'     => 'New ' . $sSingular . ' Name',
                'menu_name'         => $sPlural,
            );

            return $aLabels;

        }
    }

// **********************************************
// PG-style pagination links
// **********************************************

    if (!function_exists('PG_Paginate')) {
        function PG_Paginate() {
            global $wp_query;

            $iBig = 999999999;
            $aLinks = paginate_links(array(
                'type' => 'array',
                'base' => str_replace($iBig, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '/page/%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => '<i></i>Previous',
                'next_text' => 'Next<i></i>',
                'mid_size' => 7,
            ));

            $iPage = get_query_var('paged');

            echo '<div class="num_pagination">';
                if($aLinks)
                    foreach($aLinks as $sLink)
                        echo $sLink;
            echo '</div>';

            if($sNext)
                echo $sNext;
        }
    }

// **********************************************
// Create on-the-fly excerpts
// **********************************************

    if(!function_exists('PG_Excerpt')) {
        function PG_Excerpt($sText, $iLength, $sPermalink = null, $sMoreText = 'Read More', $bStripTags = true) {

            if($bStripTags) {
                $sText = wp_strip_all_tags($sText, true);
            }

            if (strlen($sText) < $iLength) {
                return $sText;
            }

            $sTextWords = explode(' ', $sText);
            $sHtml = null;

            foreach ($sTextWords as $sWord) {

                if ((strlen($sWord) > $iLength) && $sHtml == null) {
                    return substr($sWord, 0, $iLength) . "...";
                }

                if ((strlen($sHtml) + strlen($sWord)) > $iLength) {
                    if($sPermalink) {
                        return $sHtml . '... <a class="readmore" href="'.$sPermalink.'">'.$sMoreText.'</a>';
                    } else {
                        return $sHtml . '...';
                    }
                }
                $sHtml.=" " . $sWord;
            }
            return $sHtml;
        }
    }
