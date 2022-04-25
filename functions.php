<?php
if (function_exists('get_field')) {
  $theme_settings = get_field('theme_settings', 'option') ? current(get_field('theme_settings', 'option')) : null;
}

$func_error = function ($message, $subtitle = '', $title = '') {
  $title = $title ?: __('Error');
  $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";

  wp_die(esc_attr($message), esc_attr($title));
};


///////////////////////////////////////////////////////////
// Level5: START Adding Styles To Theme
///////////////////////////////////////////////////////////

function theme_styles()
	{
	    wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/build/css/main.css' );
	}
    add_action( 'wp_enqueue_scripts', 'theme_styles' ); 

///////////////////////////////////////////////////////////
// Level5: END Adding Styles To Theme
///////////////////////////////////////////////////////////



$includes = [
  'setup',
  'cleanup',
  'svg',
  'assets',
  //'post-types/vacancies',
  //'get_pages_by_template',
  //'post-types/staff',
  //'post-types/pa',
  //'post-types/videos',
  //'post-types/community',
  //'post-types/blog',
  //'post-types/events',
  'post-types/case-study',
  //'taxonomies/blog_category',
  'menu',
  //'courses',
  'ajax/news',
  'ajax/case-study',
  'sidebar-nav',
  'pagination',
  'sidebars',
  'helpers',
  'acf',
  'custom',
  'rest-api',
  //'api/facebook',
  //'api/instagram',
  //'api/twitter',
  //'api/flickr',
  'gravity-forms',
  'emergency'
];

array_map(function ($file) use ($func_error) {
  $file = "functions/{$file}.php";

  if (!locate_template($file, true, true)) {
    $func_error(sprintf(__('Error locating <code>%s</code> for inclusion.'), $file), 'File not found');
  }
}, $includes);


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
  .acf-flexible-content .layout {
    border: 5px solid #4cbb17;
    background: #eaeaea;
    border-radius: 5px;
  }

  .acf-flexible-content .layout .acf-fc-layout-handle {
    background: #ea5a0b;
    background: #4cbb17;
    color: #fff;
    font-weight: bold;
  }

  .acf-flexible-content .layout .acf-fc-layout-order {
    background: #4cbb17;
    color: #fff;
  }
  </style>';
};

add_filter('acf/validate_value/name=block_styles', 'only_allow_2', 20, 4);

function only_allow_2($valid, $value, $field, $input) {
  if (count($value) > 2) {
    $valid = 'Only Select 2';
  }
  return $valid;
};

add_filter( 'gform_confirmation_6', 'custom_confirmation', 10, 4 );
function custom_confirmation( $confirmation, $form, $entry, $ajax ) {

    $paymentMethod = $entry[33];

    if (!empty($paymentMethod)) {
      $costPerPerson = 10;
      $numAttendees = $entry[34];
      $bookingTotalCost = $costPerPerson * $numAttendees;
    }

    $confirmation = "<p>Thank you for your interest in our event at Christ's Hospital. We will be in touch shortly to confirm your booking by email.</p>";

    if (!empty($paymentMethod) && $paymentMethod == "Cheque") {
      $confirmation .= "<p><strong>Important:</strong> You have chosen to pay for your booking by cheque. The total cost of this booking is <strong>&pound;".$bookingTotalCost."</strong>. <br>Cheques should be made payable to 'Christs Hospital'. <br>Please send your check via post to 'Christ's Hospital Museum, Christ's Hospital, Horsham, West Sussex, RH13 0LJ'.</p>";
    } elseif (!empty($paymentMethod) && $paymentMethod == "Paypal") {
      $confirmation .= "<div class='showPayPalCheckout'><p><strong>Important:</strong> You have chosen to pay for your booking by PayPal. The total cost of this booking is <strong>&pound;".$bookingTotalCost."</strong>. Please use one of the buttons below to make a payment.</p>";
      $confirmation .= "
              <div id='paypal-button-container'></div>

              <script src='https://www.paypalobjects.com/api/checkout.js'></script>
              <script>
                // Render the PayPal button
                paypal.Button.render({
                // Set your environment
                env: 'production', // sandbox | production

                // Specify the style of the button
                style: {
                  layout: 'vertical',  // horizontal | vertical
                  size:   'medium',    // medium | large | responsive
                  shape:  'rect',      // pill | rect
                  color:  'gold'       // gold | blue | silver | white | black
                },

                // Specify allowed and disallowed funding sources
                //
                // Options:
                // - paypal.FUNDING.CARD
                // - paypal.FUNDING.CREDIT
                // - paypal.FUNDING.ELV
                funding: {
                  allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.CREDIT
                  ],
                  disallowed: []
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,

                // PayPal Client IDs - replace with your own
                // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                client: {
                  //sandbox: 'ARYd19jIjIRq3M9C02zgXrs8ZfWluuYpdkw1yV1NWs3CVKXZzxG5GFVcRuSAYgF9N3UEy43f3Oa_7Xb9',
                  production: 'Aft-b-rptQZnTWJHChplvl6QHE-d5eb71UohHAmF5jfF7R5kpoC761RjgmAJXUoDXLrKWRoQjEXNs-ZN'
                },

                payment: function (data, actions) {
                  return actions.payment.create({
                    payment: {
                      transactions: [
                        {
                          amount: {
                            total: ".$bookingTotalCost.",
                            currency: 'GBP'
                          },
                          description: 'Brangwyn tour website booking.',
                        }
                      ]
                    }
                  });
                },

                onAuthorize: function (data, actions) {
                  return actions.payment.execute()
                    .then(function () {
                      $('.showPayPalCheckout').hide();
                      $('.paymentAuthorised').show();
                    });
                }
                }, '#paypal-button-container');
              </script>
            </div>
            <div class='paymentAuthorised' style='display: none;'><p>Your payment has been authorized. We will be in contact soon to confirm your booking by email.</p></div>";
    }

    return $confirmation;
}

function str_split_unicode($str, $l = 0) {
  if ($l > 0) {
      $ret = array();
      $len = mb_strlen($str, "UTF-8");
      for ($i = 0; $i < $len; $i += $l) {
          $ret[] = mb_substr($str, $i, $l, "UTF-8");
      }
      return $ret;
  }
  return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}