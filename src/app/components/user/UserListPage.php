<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/aside.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/user-list.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
        const PAGES = parseInt("<?= $this->data['pages'] ?? 0 ?>");
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/user-list.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>User List</title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Main -->
            <div class="pad-40">
                <h1 class="user-list-header">Users on Binotify</h1>
                <?php if (!$this->data['users']) : ?>
                    <p class="info">There are no users yet available on Binotify!</p>
                <?php else : ?>
                    <div class="users-list">
                        <?php foreach ($this->data['users'] as $user) : ?>
                            <div class="single-user">
                                <div class="left-field">
                                    <p>Name:</p>
                                    <p>Email:</p>
                                    <p>Username:</p>
                                    <p>Type:</p>
                                </div>
                                <div class="right-field">
                                    <p>"<?= $user->fullname ?>"</p>
                                    <p>"<?= $user->email ?>"</p>
                                    <p>"<?= $user->username ?>"</p>
                                    <?php if ($user->is_admin) : ?>
                                        <p>"Admin"</p>
                                    <?php else : ?>
                                        <p>"User"</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination">
                        <p id="pagination-text">Page <span id="page-number">1</span> out of <?= $this->data['pages'] ?> pages</p>
                        <div class="pagination-buttons">
                            <button id="prev-page" disabled>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-left.svg" alt="">
                            </button>
                            <button id="next-page" <?php if ($this->data['pages'] == 1) : ?> disabled <? endif; ?>>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-right.svg" alt="">
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>