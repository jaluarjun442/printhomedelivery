  <?php if ($data->au_red == 1) {
        http_response_code(302);
        $red_go_to = $data['buy_now_link'];
        header("Refresh: 1; url={$red_go_to}");
        exit();
    } ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Redirecting...</title>
      <style>
          body {
              margin: 0;
              padding: 0;
              font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
              background-color: #f9fafb;
              color: #1f2937;
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              height: 100vh;
              text-align: center;
          }

          .container {
              max-width: 400px;
              padding: 2rem;
          }

          .spinner {
              width: 50px;
              height: 50px;
              border: 5px solid #e5e7eb;
              border-top: 5px solid #3b82f6;
              border-radius: 50%;
              animation: spin 1s linear infinite;
              margin: 0 auto 1.5rem auto;
          }

          @keyframes spin {
              0% {
                  transform: rotate(0deg);
              }

              100% {
                  transform: rotate(360deg);
              }
          }

          h1 {
              font-size: 1.5rem;
              margin-bottom: 0.5rem;
              font-weight: 600;
          }

          p {
              color: #4b5563;
              font-size: 1rem;
              margin-bottom: 1.5rem;
          }

          .fallback-link {
              color: #3b82f6;
              text-decoration: none;
              font-weight: 500;
          }

          .fallback-link:hover {
              text-decoration: underline;
          }
      </style>
  </head>

  <body>
      <?php
        if ($data != null) {
        ?>
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <img style="width: 250px; height: auto;" src="<?php echo asset('uploads/product') . '/' . $data->products_images->first()['image']; ?>" />
                      <h3>{{ $data['name']; }}</h3>
                  </div>
              </div>
              <div class="spinner"></div>
              <h1>Connecting you to your product</h1>
              <p>Please wait while we redirect you...</p>
              <p style="font-size: 0.875rem;">
                  If you are not redirected automatically,
                  <a id="redirect-link" class="fallback-link redirect-link" href="{{ $data['buy_now_link']; }}">click here</a>.
              </p>
          </div>
          <?php
            http_response_code(302);
            if ($data['au_red'] == 1) {
                $red_tim = store_data()['red_tim'];
                header("Refresh: {$red_tim}; url={$data['buy_now_link']}");
                exit();
            } else {
                $red_tim = 5;
                header("Refresh: {$red_tim}; url={$data['buy_now_link']}");
                exit();
            }
            ?>
      <?php } else { ?>
          <div class="container">
              <div class="spinner"></div>
              <h1>Oooops... Product Not Found.</h1>

          </div>
      <?php } ?>

  </body>

  </html>