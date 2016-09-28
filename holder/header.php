<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageTitle ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-schemes.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/js/metro.min.js"></script>
    </head>
    <body class="bg-darkTeal">
        <div class="app-bar" style="background-color: #10809C;">
            <a class="app-bar-element" href="index.php">
                <span class="mif-home mif-2x"></span>
            </a>
            <div class="app-bar-element place-right">
                <?php if (!$currentUser) : ?>
                    <a class="dropdown-toggle fg-white"><span class="mif-enter"></span> Enter</a>
                    <div class="app-bar-drop-container bg-white fg-dark place-right"
                         data-role="dropdown" data-no-close="true">
                        <div class="padding20">
                            <form action="login.php" method="post">
                                <h4 class="text-light">Login</h4>
                                <div class="input-control text">
                                    <span class="mif-user prepend-icon"></span>
                                    <input type="text" name="email">
                                </div>
                                <div class="input-control text">
                                    <span class="mif-lock prepend-icon"></span>
                                    <input type="password" name="password">
                                </div>
                                <label class="input-control checkbox small-check">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                    <span class="caption">Remember me</span>
                                </label>
                                <div class="form-actions">
                                    <button class="button">Login</button>
                                    <button class="button link">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <a class="fg-white" href="logout.php"><?php echo $currentUser['username'] ?> <span class="mif-exit"></span></a>
                <?php endif ?>
            </div>
        </div>
        <div class="container" style="background-color: white;margin-top: 24px;">

