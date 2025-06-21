<?php

include_once '../../back-end/conexion/conexion.php';

session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {


?>

  <!DOCTYPE html>
  <html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>

    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div id="app">

      <!-- Inicio de NavBar -->
      <?php require_once '../components/nav.php' ?>
      <!-- Final de NavBar -->

      <!-- Inicio Aside -->
      <?php require_once '../components/aside.php' ?>
      <!-- Final Aside -->

      <section class="section is-title-bar">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <ul>
                <li>Admin</li>
                <li>Profile</li>
              </ul>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="https://github.com/vikdiesel/admin-one-bulma-dashboard" target="_blank" class="button is-primary">
                  <span class="icon"><i class="mdi mdi-github-circle"></i></span>
                  <span>GitHub</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                <h1 class="title">
                  Profile
                </h1>
              </div>
            </div>
            <div class="level-right" style="display: none;">
              <div class="level-item"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section is-main-section">
        <div class="tile is-ancestor">
          <div class="tile is-parent">
            <div class="card tile is-child">
              <header class="card-header">
                <p class="card-header-title">
                  <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                  Edit Profile
                </p>
              </header>
              <div class="card-content">
                <form>
                  <div class="field is-horizontal">
                    <div class="field-label is-normal"><label class="label">Avatar</label></div>
                    <div class="field-body">
                      <div class="field">
                        <div class="field file">
                          <label class="upload control">
                            <a class="button is-primary">
                              <span class="icon"><i class="mdi mdi-upload default"></i></span>
                              <span>Pick a file</span>
                            </a>
                            <input type="file">
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="field is-horizontal">
                    <div class="field-label is-normal">
                      <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                      <div class="field">
                        <div class="control">
                          <input type="text" autocomplete="on" name="name" value="John Doe" class="input" required>
                        </div>
                        <p class="help">Required. Your name</p>
                      </div>
                    </div>
                  </div>
                  <div class="field is-horizontal">
                    <div class="field-label is-normal">
                      <label class="label">E-mail</label>
                    </div>
                    <div class="field-body">
                      <div class="field">
                        <div class="control">
                          <input type="email" autocomplete="on" name="email" value="user@example.com" class="input" required>
                        </div>
                        <p class="help">Required. Your e-mail</p>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                      <div class="field">
                        <div class="control">
                          <button type="submit" class="button is-primary">
                            Submit
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tile is-parent">
            <div class="card tile is-child">
              <header class="card-header">
                <p class="card-header-title">
                  <span class="icon"><i class="mdi mdi-account default"></i></span>
                  Profile
                </p>
              </header>
              <div class="card-content">
                <div class="is-user-avatar image has-max-width is-aligned-center">
                  <img src="https://avatars.dicebear.com/v2/initials/john-doe.svg" alt="John Doe">
                </div>
                <hr>
                <div class="field">
                  <label class="label">Name</label>
                  <div class="control is-clearfix">
                    <input type="text" readonly value="John Doe" class="input is-static">
                  </div>
                </div>
                <hr>
                <div class="field">
                  <label class="label">E-mail</label>
                  <div class="control is-clearfix">
                    <input type="text" readonly value="user@example.com" class="input is-static">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-lock default"></i></span>
              Change Password
            </p>
          </header>
          <div class="card-content">
            <form>
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Current password</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="password" name="password_current" autocomplete="current-password" class="input" required>
                    </div>
                    <p class="help">Required. Your current password</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">New password</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="password" autocomplete="new-password" name="password" class="input" required>
                    </div>
                    <p class="help">Required. New password</p>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Confirm password</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="password" autocomplete="new-password" name="password_confirmation" class="input" required>
                    </div>
                    <p class="help">Required. New password one more time</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <button type="submit" class="button is-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <!-- Inicio footer -->
      <?php require '../components/footer.php' ?>
      <!-- Final Footer -->

      <div id="sample-modal" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Confirm action</p>
            <button class="delete jb-modal-close" aria-label="close"></button>
          </header>
          <section class="modal-card-body">
            <p>This will permanently delete <b>Some Object</b></p>
            <p>This is sample modal</p>
          </section>
          <footer class="modal-card-foot">
            <button class="button jb-modal-close">Cancel</button>
            <button class="button is-danger jb-modal-close">Delete</button>
          </footer>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
      </div>
    </div>

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="../assets/js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  </body>

  </html>
<?php
}
?>